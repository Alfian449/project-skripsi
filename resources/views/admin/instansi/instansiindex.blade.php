@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Instansi</h5>
        </form>
    </nav>

    @php
        $ar_instansi = ['No', 'Nama', 'Penanggung Jawab', 'Email', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Instansi</h3>
    <br>
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <div class="d-flex">
                <a class="btn btn-primary ml-3" href="{{ route('instansi.create') }}">Tambah</a>
            </div>
            <form action="{{ route('instansi.import') }}" method="POST" enctype="multipart/form-data" class="ml-3 mt-2">
                @csrf
                <input type="file" name="file" class="form-control mb-2">
                <button class="btn btn-success">Import Data Instansi</button>
            </form>
        </div>
        <form action="{{ route('searchinstansi') }}" method="GET" class="form-inline">
            <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>

    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_instansi as $ainstansi)
                    <th scope="col">{{ $ainstansi }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($instansis as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->guru->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-success mr-1" href="{{ route('instansi.edit', $row->id) }}">Edit</a>
                            <a class="btn btn-info mr-1" href="{{ route('instansi.show', $row->id) }}">Detail</a>
                            <form method="POST" action="{{ route('instansi.destroy', $row->id) }}" onsubmit="return confirm('Apakah Anda Yakin Data Dihapus?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
