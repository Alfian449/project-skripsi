@extends('layout.halguru')

@section('content')
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <h5 class="h5 mb-0 text-gray-800">Dashboard Guru</h5>
    </form>
</nav>

<div class="container-fluid p-4">
    <h1 class="mb-4">Dashboard</h1>
    @auth
    <div class="card mb-4">
        <div class="card-header">
            <h3>Selamat Datang</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/gurus/' . $guru->foto) }}" alt="Foto Guru" class="img-fluid img-thumbnail mb-3">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" value="{{ $guru->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" value="{{ $guru->jenis_kelamin }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone" value="{{ $guru->phone }}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" value="{{ $guru->alamat }}" readonly>
                        </div>
                        <!-- Tambahkan field lainnya jika diperlukan -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="alert alert-warning" role="alert">
        Anda belum login.
    </div>
    @endauth
</div>
@endsection
