@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Siswa</h5>
        </form>
    </nav>

    <h3 class="ml-3">Update Siswa</h3>
    <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group ml-3">
            <label>NIS</label>
            <input type="text" name="nis" value="{{ $siswa->nis }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Username</label>
            <input type="text" name="username" value="{{ $siswa->username }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $siswa->name }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Password</label>
            <input type="text" name="password" value="{{ $siswa->password }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label for="kelas">Kelas</label>
            <select class="form-control" name="kelas">
                <option value="">Pilih Kelas</option>
                <option value="XI RPL 1" {{ $siswa->kelas == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                <option value="XI RPL 2" {{ $siswa->kelas == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                <option value="XI MM 1" {{ $siswa->kelas == 'XI MM 1' ? 'selected' : '' }}>XI MM 1</option>
                <option value="XI MM 2" {{ $siswa->kelas == 'XI MM 2' ? 'selected' : '' }}>XI MM 2</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $siswa->phone }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $siswa->alamat }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('siswa.index') }}">Batal</a>
    </form>
@endsection
