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
        //get posts
        $data_rs_covid = Http::get('https://data.jakarta.go.id/read-resource/get-json/daftar-rumah-sakit-rujukan-penanggulangan-covid-19/65d650ae-31c8-4353-a72b-3312fd0cc187');
        $data1 = $data_rs_covid->json();

        $data_rs = Http::get('https://data.jakarta.go.id/read-resource/get-json/rsdkijakarta-2017-10/8e179e38-c1a4-4273-872e-361d90b68434');
        $data2 = $data_rs->json();

        $data_merge = array_merge($data1,$data2);
        //return collection of posts as a resource
        return new ApiResource(true, 'List Data', $data_merge);

    }

    public function show($filter)
    {
        //get posts
        $data_rs_covid = Http::get('https://data.jakarta.go.id/read-resource/get-json/daftar-rumah-sakit-rujukan-penanggulangan-covid-19/65d650ae-31c8-4353-a72b-3312fd0cc187');
        $data1 = $data_rs_covid->json();

        $data_rs = Http::get('https://data.jakarta.go.id/read-resource/get-json/rsdkijakarta-2017-10/8e179e38-c1a4-4273-872e-361d90b68434');
        $data2 = $data_rs->json();

        $data_merge = array_merge($data1,$data2);
        $data_search = array_search($filter,$data_merge);
        //return collection of posts as a resource
        return new ApiResource(true, 'List Data', $data_search);

    }
}
