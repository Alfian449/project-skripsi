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
        $ar_instansi = ['No', 'Nama', 'Penanggung Jawab', 'Email', 'Bidang', 'Kuota', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Instansi</h3>
    <br>

    <div class="row">
        <!-- Bagian Kiri: Tambah dan Import -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="d-flex flex-wrap">
                <a class="btn btn-primary mb-2 ml-2" href="{{ route('instansi.create') }}">Tambah</a>
            </div>
            <form action="{{ route('instansi.import') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column">
                @csrf
                <!-- Kontrol lebar input file dan tombol import -->
                <input type="file" name="file" class="form-control mt-2 col-lg-4 col-md-6 col-sm-12 ml-2">
                <button class="btn btn-success mt-2 col-lg-4 col-md-6 col-sm-12 ml-2">Import Data Instansi</button>
            </form>
        </div>

        <!-- Bagian Kanan: Pencarian -->
        <div class="col-lg-4 col-md-5 col-sm-12">
            <form action="{{ route('searchinstansi') }}" method="GET" class="form-inline">
                <input class="form-control mr-2 mb-2 ml-2" type="text" name="query" placeholder="Search for a name">
                <button class="btn btn-success mb-2 ml-2" type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
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
                        <td>{{ $row->bidang }}</td>
                        <td>{{ $row->kuota }}</td>
                        <td>
                            <div class="d-flex flex-column flex-md-row">
                                <a class="btn btn-success mb-1 mr-md-1" href="{{ route('instansi.edit', $row->id) }}">Edit</a>
                                <a class="btn btn-info mb-1 mr-md-1" href="{{ route('instansi.show', $row->id) }}">Detail</a>
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
    </div>
@endsection
