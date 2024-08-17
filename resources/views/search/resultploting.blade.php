@extends('layout.app')

@section('content')
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <h5 class="h5 mb-0 text-gray-800">Halaman Pencarian Ploting Siswa</h5>
    </form>
</nav>

<style>
    .table-container {
        overflow-x: auto;
        max-width: 100%;
    }
</style>

<div>
    <h2 class="ml-3">Data Ploting Siswa</h2>
    <nav aria-label="breadcrumb" class="ml-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/siswa') }}">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
        </ol>
    </nav>
    <div class="table-container">
        <table class="table table-striped table-hover mt-3 ml-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Nama Instansi</th>
                    <th>Penanggung Jawab</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultploting as $result)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $result->user->name }}</td>
                        <td>{{ $result->user->nis }}</td>
                        <td>{{ $result->instansi->name }}</td>
                        <td>{{ $result->instansi->guru_id }}</td>
                        <td>{{ $result->jurusan }}</td>
                            {{-- <div class="d-flex">
                                <a class="btn btn-success mr-1" href="{{ route('siswa.edit', $result->id) }}">Edit</a>
                                <a class="btn btn-info mr-1" href="{{ route('siswa.show', $result->id) }}">Detail</a>
                                <form method="POST" action="{{ route('siswa.destroy', $result->id) }}" onsubmit="return confirm('Apakah Anda Yakin Data Dihapus?')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                            </div> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
