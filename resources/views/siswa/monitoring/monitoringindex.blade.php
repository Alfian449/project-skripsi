@extends('layout.halsiswa')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">LogBook Kegiatan Siswa</h5>
        </form>
    </nav>

    @php
        $ar_monitoring = ['No', 'Nama Kegiatan', 'Keterangan', 'Tanggal',];
        $no = 1;
    @endphp

    <h3 class="ml-3">Logbook Kegiatan Siswa</h3>
    <br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('searchlogbook') }}" method="GET" class="form-inline">
            <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>

    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_monitoring as $amonitoring)
                    <th scope="col">{{ $amonitoring }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($monitoring as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ $row->nama_kegiatan }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>{{ $row->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
