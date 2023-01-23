<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Rs</th>
                            <th scope="col">Jenis Rumah Sakit</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kota Madya</th>
                            <th scope="col">Kelurahan</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Nomor Telpon</th>
                            <th scope="col">Nomor Fax</th>
                            <th scope="col">Kode Pos</th>
                            <th scope="col">Website</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data_rs as $datas)   
                        <tr>
                            <td>{{ $datas['nama_rumah_sakit'] }}</td>
                            <td>{{ $datas['jenis_rumah_sakit'] }}</td>
                            <td>{{ $datas['alamat_lengkap'] }}</td>
                            <td>{{ $datas['kota_madya'] }}</td>
                            <td>{{ $datas['kelurahan']}}</td>
                            <td>{{ $datas['kecamatan']}}</td>                
                            <td>{{ $datas['no_telpon']}}</td>                
                            <td>{{ $datas['no_fax']}}</td>                
                            <td>{{ $datas['kode_pos']}}</td>                
                            <td>{{ $datas['website']}}</td>                
                            <td>{{ $datas['email']}}</td>                
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
                </div>

            </div>
        </div>

    </div>

    </body>
</html>