@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Guru</h5>
        </form>
    </nav>

    <h3 class="ml-3">Update Guru</h3>
    @foreach ($guru as $rs)
        <form method="POST" action="{{ route('guru.update', $rs->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group ml-3">
                <label>Username</label>
                <input type="text" name="username" value="{{ $rs->username }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $rs->name }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Password</label>
                <input type="text" name="password" value="{{ $rs->password }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" value="{{ $rs->jenis_kelamin }}">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group ml-3">
                <label>phone</label>
                <input type="text" name="phone" value="{{ $rs->phone }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $rs->alamat }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Foto</label>
                <input type="file" name="foto" value="{{ $rs->foto }}" class="form-control">
            </div>

            <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
            <a class="btn btn-success" href="{{ route('guru.index') }}">Batal</a>
        </form>
    @endforeach
@endsection
