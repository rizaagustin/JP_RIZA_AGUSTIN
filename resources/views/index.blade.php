<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>

{{-- @php
    dd($data);
@endphp --}}

<div class="container">
    <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Provinsi</th>
                <th scope="col">Positif</th>
                <th scope="col">Sembuh</th>
                <th scope="col">Meninggal</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $datas)   
              <tr>
                <td>{{ $datas['nama_rumah_sakit'] }}</td>
                {{-- <td>{{ $datas['attributes']['Kasus_Posi'] }}</td>
                <td>{{ $datas['attributes']['Kasus_Semb'] }}</td>
                <td>{{ $datas['attributes']['Kasus_Meni'] }}</td> --}}
              </tr>
            @endforeach 
            </tbody>
          </table>
</div>