<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Http;

class RsCovidController extends Controller
{
    
    public function index()
    {
        $response_rs_covid = Http::get('https://data.jakarta.go.id/read-resource/get-json/daftar-rumah-sakit-rujukan-penanggulangan-covid-19/65d650ae-31c8-4353-a72b-3312fd0cc187');

        $response_rs_jakarta = Http::get('https://data.jakarta.go.id/read-resource/get-json/rsdkijakarta-2017-10/8e179e38-c1a4-4273-872e-361d90b68434');

        $rs_covid = json_decode($response_rs_covid,true);
        $rs_jakarta = json_decode($response_rs_jakarta,true);

        $threshold = 80;
        $index=0;
        $data_rs = [];
        foreach($rs_covid as $data_rs_covid){

            $regex_rs_covid_alamat = preg_replace("/[^a-zA-Z0-9]/","",$data_rs_covid['alamat']);
            foreach($rs_jakarta as $data_rs_jakarta){
                $regex_rs_jakarta = strtoupper(preg_replace("/[^a-zA-Z0-9]/","",$data_rs_jakarta['alamat_rumah_sakit']));
                similar_text($regex_rs_covid_alamat, $regex_rs_jakarta, $percent);
                if($percent >= $threshold) {
                    $data_rs[$index]['nama_rumah_sakit'] = $data_rs_covid['nama_rumah_sakit'];
                    $data_rs[$index]['kelurahan'] = $data_rs_covid['kelurahan'];
                    $data_rs[$index]['kecamatan'] = $data_rs_covid['kecamatan'];
                    $data_rs[$index]['kota_madya'] = $data_rs_covid['kota_madya'];
                    $data_rs[$index]['no_telpon'] = $data_rs_jakarta['nomor_telepon'];
                    $data_rs[$index]['kode_pos'] = $data_rs_jakarta['kode_pos'];
                    $data_rs[$index]['no_fax'] = $data_rs_jakarta['nomor_fax'];
                    $data_rs[$index]['no_hp_direktur/kepala_rs'] = $data_rs_jakarta['no_hp_direktur/kepala_rs'];
                    $data_rs[$index]['website'] = $data_rs_jakarta['website'];
                    $data_rs[$index]['email'] = $data_rs_jakarta['email'];
                    $data_rs[$index]['alamat_lengkap'] = strtoupper($data_rs_jakarta['alamat_rumah_sakit']);
                    $data_rs[$index]['jenis_rumah_sakit'] = strtoupper($data_rs_jakarta['jenis_rumah_sakit']);
                    $index++;
                }
            }
        }


        return new ApiResource($data_rs);

    }

    public function filter(Request $request)
    {
        
        $response_rs_covid = Http::get('https://data.jakarta.go.id/read-resource/get-json/daftar-rumah-sakit-rujukan-penanggulangan-covid-19/65d650ae-31c8-4353-a72b-3312fd0cc187');

        $response_rs_jakarta = Http::get('https://data.jakarta.go.id/read-resource/get-json/rsdkijakarta-2017-10/8e179e38-c1a4-4273-872e-361d90b68434');

        $rs_covid = json_decode($response_rs_covid,true);
        $rs_jakarta = json_decode($response_rs_jakarta,true);

        $threshold = 80;
        $index=0;
        $data_rs = [];
        foreach($rs_covid as $data_rs_covid){

            if (count($request->all()) > 0) {
                if (!empty($request->kelurahan) && $request->kelurahan !== $data_rs_covid['kelurahan']) {
                    continue;
                }
                
                if(!empty($request->kecamatan) && $request->kecamatan !== $data_rs_covid['kecamatan']){
                    continue;
                }        
    
                if(!empty($request->kota_madya) && $request->kota_madya !== $data_rs_covid['kota_madya']){
                    continue;
                }        
            }


            $regex_rs_covid_alamat = preg_replace("/[^a-zA-Z0-9]/","",$data_rs_covid['alamat']);
            foreach($rs_jakarta as $data_rs_jakarta){
                $regex_rs_jakarta = strtoupper(preg_replace("/[^a-zA-Z0-9]/","",$data_rs_jakarta['alamat_rumah_sakit']));
                similar_text($regex_rs_covid_alamat, $regex_rs_jakarta, $percent);

                if($percent >= $threshold) {
                    $data_rs[$index]['nama_rumah_sakit'] = $data_rs_covid['nama_rumah_sakit'];
                    $data_rs[$index]['kelurahan'] = $data_rs_covid['kelurahan'];
                    $data_rs[$index]['kecamatan'] = $data_rs_covid['kecamatan'];
                    $data_rs[$index]['kota_madya'] = $data_rs_covid['kota_madya'];
                    $data_rs[$index]['no_telpon'] = $data_rs_jakarta['nomor_telepon'];
                    $data_rs[$index]['kode_pos'] = $data_rs_jakarta['kode_pos'];
                    $data_rs[$index]['no_fax'] = $data_rs_jakarta['nomor_fax'];
                    $data_rs[$index]['no_hp_direktur/kepala_rs'] = $data_rs_jakarta['no_hp_direktur/kepala_rs'];
                    $data_rs[$index]['website'] = $data_rs_jakarta['website'];
                    $data_rs[$index]['email'] = $data_rs_jakarta['email'];
                    $data_rs[$index]['alamat_lengkap'] = strtoupper($data_rs_jakarta['alamat_rumah_sakit']);
                    $data_rs[$index]['jenis_rumah_sakit'] = strtoupper($data_rs_jakarta['jenis_rumah_sakit']);
                    $index++;
                }

            }

        }

        if (count($data_rs) == 0) {
            $data = ['message' => 'Data Not Found'];
            return response()->json($data,404);
        }
        
        return new ApiResource($data_rs);

    }
}

// if (trim(count($request->all()) > 0 && strtoupper($request->kelurahan) <> $data_rs_covid['kelurahan'] && strtoupper($request->kecamatan) <> $data_rs_covid['kecamatan'] && strtoupper($request->kota_madya) <> $data_rs_covid['kota_madya'])) {
//     continue;
// }