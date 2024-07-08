@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Instansi</h5>
        </form>
    </nav>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Data Instansi</title>
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

            .action-btn {
                margin-bottom: 5px;
            }
        </style>
    </head>

    <body>
        <div>
            <h2 class="ml-3">Data Instansi</h2>
            <nav aria-label="breadcrumb" class="ml-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/instansi') }}">Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
                </ol>
            </nav>
            <table class="table table-striped mt-3 ml-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultsinstansi as $result)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->alamat }}</td>
                            <td>{{ $result->phone }}</td>
                            <td>{{ $result->email }}</td>
                            <td>
                                <form method="POST" action="{{ route('instansi.destroy', $result->id) }}">
                                    @csrf
                                    @method('delete')
                                    <a class="btn btn-success action-btn"
                                        href="{{ route('instansi.edit', $result->id) }}">Edit</a>
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
