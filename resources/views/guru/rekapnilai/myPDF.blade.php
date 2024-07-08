<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th class="mr-3">Nama Siswa</th>
            <th class="mr-3">Kedisiplinan</th>
            <th class="mr-3">Tanggung Jawab</th>
            <th class="mr-3">Komunikasi</th>
            <th class="mr-3">Kerja Sama</th>
            <th class="mr-3">inisiatif</th>
            <th class="mr-3">Ketekunan</th>
            <th class="mr-3">Kreativitas</th>
        </tr>
        @foreach($rekapnilai as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->kedisiplinan }}</td>
            <td>{{ $user->tanggung_jawab }}</td>
            <td>{{ $user->komunikasi }}</td>
            <td>{{ $user->kerja_sama }}</td>
            <td>{{ $user->inisiatif }}</td>
            <td>{{ $user->ketekunan }}</td>
            <td>{{ $user->kreativitas }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
