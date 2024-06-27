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

    <!DOCTYPE html>
    <html>

    <head>
        <title>Data Guru</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 0px solid black;
            }

            th,
            td {
                padding: 15px;
                text-align: left;
            }
        </style>
    </head>

    <body>
        <div>
            <h2 class="ml-3">Data Guru</h2>
            <nav aria-label="breadcrumb" class="ml-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/guru') }}">Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
                </ol>
            </nav>
            <table class="table table-striped mt-3 ml-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
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
                            <td>{{ $result->username }}</td>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->jenis_kelamin }}</td>
                            <td>{{ $result->phone }}</td>
                            <td>{{ $result->alamat }}</td>
                            <td>
                                @if (!empty($result->foto) && file_exists(public_path('images/guru/' . $result->foto)))
                                    <img src="{{ asset('images/guru/' . $result->foto) }}" alt="{{ $result->name }}"
                                        width="90">
                                @else
                                    <img src="{{ asset('images/nophoto.png') }}" alt="{{ $result->name }}" width="90">
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('guru.destroy', $result->id) }}">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-success action-btn"
                                        href="{{ route('guru.edit', $result->id) }}">Edit</a>
                                    <button class="btn btn-danger action-btn"
                                        onclick="return confirm('Apakah Anda Yakin Data Dihapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>

    </html>
@endsection
