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

    <h3 class="ml-3">Tambah Siswa</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('siswa.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group ml-3">
            <label>NIS</label>
            <input type="text" name="nis" value="" class="form-control" placeholder="Masukkan NIS SIswa">
        </div>

        <div class="form-group ml-3">
            <label>Username</label>
            <input type="text" name="username" value="" class="form-control" placeholder="Masukkan Username SIswa">
        </div>

        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="" class="form-control" placeholder="Masukkan Nama SIswa">
        </div>

        <div class="form-group ml-3">
            <label>Password</label>
            <input type="password" name="password" value="" class="form-control"placeholder="Masukkan Password SIswa">
        </div>

        <div class="form-group ml-3">
            <label for="kelas">Kelas</label>
            <select class="form-control" name="kelas">
                <option value="">Pilih Kelas</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
                <option value="XI TKJ 2">XI TKJ 2</option>
                <option value="XI DKV 2">XI DKV 1</option>
                <option value="XI DKV 2">XI DKV 2</option>
                <option value="XI OTKP 2">XI OTKP 1</option>
                <option value="XI OTKP 2">XI OTKP 2</option>
                <option value="XI AKL 2">XI AKL 1</option>
                <option value="XI AKL 2">XI AKL 2</option>
                <option value="XI BDP 2">XI BDP 1</option>
                <option value="XI BDP 2">XI BDP 2</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label>phone</label>
            <input type="text" name="phone" value="" class="form-control" placeholder="Masukkan No HP SIswa">
        </div>

        <div class="form-group ml-3">
            <label for="tahun_pelajaran">Tahun Pelajaran</label>
            <select class="form-control" name="tahun_pelajaran">
                <option value="">Pilih Tahun Pelajaran</option>
                <option value="2023/2024">2023/2024</option>
                <option value="2024/2025">2024/2025</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="" class="form-control" placeholder="Masukkan Alamat SIswa">
        </div>

        <div class="form-group ml-3">
            <label>Foto</label>
            <input type="file" name="foto" value="" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('siswa.index') }}">Batal</a>
    </form>
@endsection
