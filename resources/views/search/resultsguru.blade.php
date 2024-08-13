@extends('layout.app')

@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Admin</h5>
        </form>
    </nav>

    <style>
        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }
    </style>

    <div>
        <h2 class="ml-3">Data Guru</h2>
        <nav aria-label="breadcrumb" class="ml-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/guru') }}">Back</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
            </ol>
        </nav>
        <div class="table-container">
            <table class="table table-striped mt-3 ml-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>NIP</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Phone</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultsguru as $result)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $result->nip }}</td>
                            <td>{{ $result->username }}</td>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->jenis_kelamin }}</td>
                            <td>{{ $result->phone }}</td>
                            <td>{{ $result->alamat }}</td>
                            <td>
                                @if (!empty($result->foto) && file_exists(public_path('uploads/gurus/' . $result->foto)))
                                    <img src="{{ asset('uploads/gurus/' . $result->foto) }}" alt="{{ $result->name }}" width="90">
                                @else
                                    <img src="{{ asset('uploads/gurus/nophoto.png') }}" alt="{{ $result->name }}" width="90">
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-success mr-1" href="{{ route('guru.edit', $result->id) }}">Edit</a>
                                    <a class="btn btn-info mr-1" href="{{ route('guru.show', $result->id) }}">Detail</a>
                                    <form method="POST" action="{{ route('guru.destroy', $result->id) }}" onsubmit="return confirm('Apakah Anda Yakin Data Dihapus?')">
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
    </div>
@endsection
