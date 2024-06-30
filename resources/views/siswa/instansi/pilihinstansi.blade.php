@extends('layout.halsiswa')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Pilih Instansi</h5>
        </form>
    </nav>

    <h3 class="ml-3">Pilih Instansi</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('logbook.store') }}">
        @csrf
        <div class="form-group ml-3">
            <label for="jurusan">Jurursan</label>
            <select class="form-control" name="jurusan">
                <option value="">Pilih Jurusan</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Akuntansi">Akuntansi</option>
                <option value="Pemasaran">Pemasaran</option>
                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                <option value="Perkantoran">Perkantoran</option>
            </select>
        </div>

        <div class="form-group ml-3">
            <label>Nama Siswa</label>
            <input type="text" name="name" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label for="jurusan">Jurursan</label>
            <select class="form-control" name="jurusan">
                <option value="">Pilih Jurusan</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Akuntansi">Akuntansi</option>
                <option value="Pemasaran">Pemasaran</option>
                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                <option value="Perkantoran">Perkantoran</option>
            </select>
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-warning" href="{{ route('logbook.index') }}">Batal</a>
    </form>
@endsection
