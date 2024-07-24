@extends('layout.app')

@section('content')
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <h5 class="h5 mb-0 text-gray-800">Halaman Pencarian Siswa</h5>
    </form>
</nav>

<div>
    <h2 class="ml-3">Data Siswa</h2>
    <nav aria-label="breadcrumb" class="ml-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/siswa') }}">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
        </ol>
    </nav>
    <table class="table table-striped table-hover mt-3 ml-3">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th>NIS</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Phone</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultssiswa as $result)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $result->nis }}</td>
                    <td>{{ $result->username }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->kelas }}</td>
                    <td>{{ $result->jenis_kelamin }}</td>
                    <td>{{ $result->phone }}</td>
                    <td>{{ $result->alamat }}</td>
                    <td>
                        @if (!empty($result->foto) && file_exists(public_path('uploads/fotos/' . $result->foto)))
                            <img src="{{ asset('uploads/fotos/' . $result->foto) }}" alt="{{ $result->name }}" width="90">
                        @else
                            <img src="{{ asset('uploads/fotos/nophoto.png') }}" alt="{{ $result->name }}" width="90">
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-success mr-1" href="{{ route('siswa.edit', $result->id) }}">Edit</a>
                            <a class="btn btn-info mr-1" href="{{ route('siswa.show', $result->id) }}">Detail</a>
                            <form method="POST" action="{{ route('siswa.destroy', $result->id) }}" onsubmit="return confirm('Apakah Anda Yakin Data Dihapus?')">
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
