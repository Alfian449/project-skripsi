@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Dashboard Admin</h5>
        </form>
    </nav>

    <div class="container-fluid p-4">
        <h1>Dashboard</h1>
        @auth
            <h3>Selamat Datang {{ auth()->user()->username }}</h3>
        @else
            aku belum login
        @endauth
        </div>
        
@endsection
