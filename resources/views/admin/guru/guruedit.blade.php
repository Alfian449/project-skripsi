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
    <form method="POST" action="{{ route('guru.update', $guru->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group ml-3">
            <label>Username</label>
            <input type="text" name="username" value="{{ $guru->username }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $guru->name }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Password</label>
            <input type="text" name="password" value="{{ $guru->password }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $guru->phone }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $guru->alamat }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('guru.index') }}">Batal</a>
    </form>
@endsection
