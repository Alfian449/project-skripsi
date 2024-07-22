@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Siswa</h5>
        </form>
    </nav>

    @php
        $ar_siswa = ['No', 'NIS',  'Nama', 'Kelas', 'Jenis Kelamin', 'Phone', 'Alamat', 'Foto', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Siswa</h3>
    <br>
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <div class="d-flex">
                <a class="btn btn-primary ml-3" href="{{ route('siswa.create') }}">Tambah</a>
                <a class="btn btn-primary ml-2" href="{{ url('siswasi-export') }}">Export To Excel</a>
            </div>

        <form action="{{ route('siswasi.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control ml-3 mt-2 m">

            <button class="btn btn-success ml-3 mt-2">Import Data Siswa</button>
        </form>

    </div>

        <form action="{{ route('searchsiswa') }}" method="GET" class="form-inline">
            <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>

    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_siswa as $asiswa)
                    <th scope="col">{{ $asiswa }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nis }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->kelas }}</td>
                    <td>{{ $row->jenis_kelamin }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>
                        @if (!empty($row->foto) && file_exists(public_path('uploads/fotos/' . $row->foto)))
                            <img src="{{ asset('uploads/fotos/' . $row->foto) }}" alt="{{ $row->name }}" width="90">
                        @else
                            <img src="{{ asset('uploads/fotos/nophoto.png') }}" alt="{{ $row->name }}" width="90">
                        @endif
                    </td>

                    <td>
                        <form method="POST" action="{{ route('siswa.destroy', $row->id) }}">
                            @csrf
                            @method('delete')
                            <a class="btn btn-success" href="{{ route('siswa.edit', $row->id) }}">Edit</a>
                            <a class="btn btn-info" href="{{ route('siswa.show', $row->id) }}">Detail</a>
                            <button class="btn btn-danger"
                                onclick="return confirm('Apakah Anda Yakin Data Dihapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
