@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman List Training</h5>
        </form>
    </nav>

    @php
        $ar_training = ['No', 'Nama Siswa', 'Nama Instansi', 'Jurusan', 'Status',];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data List Training</h3>
    <br>


    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_training as $atraining)
                    <th scope="col">{{ $atraining }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($training as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ $row->instansi->name }}</td>
                    <td>{{ $row->jurusan }}</td>
                    <td>{{ $row->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
