<!-- resources/views/siswa/info_instansi.blade.php -->
@extends('layout.halsiswa')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Info Instansi</h5>
        </form>
    </nav>

    @php
        $ar_info = ['No', 'Nama Instansi', 'Bidang', 'Kuota'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Info Instansi</h3>
    <br>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
        <table class="table table-striped mt-3 ml-3">
            <thead>
                <tr>
                    @foreach ($ar_info as $ainfo)
                        <th scope="col">{{ $ainfo }}</th>
                    @endforeach
                </tr>
            </thead>
        <tbody>
            @foreach ($instansi as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->bidang }}</td>
                    <td>{{ $data->kuota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
