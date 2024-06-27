@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Admin</h5>
        </form>
    </nav>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Detail Admin</h1>
            @foreach ($admin as $rs)
                Nama : {{ $rs->nama }}<br>
                Username : {{ $rs->username }}<br>
                Password : {{ $rs->password }}
            @endforeach
            <br>
            <a class="btn btn-success" href="{{ route('admin.index') }}">Kembali</a>
        </div>
    </div>
@endsection
