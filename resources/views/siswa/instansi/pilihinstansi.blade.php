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

    <h3 class="ml-3">Magang</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('trainings.store') }}">
        @csrf
        <div class="form-group ml-3">
            <label for="instansi">Pilih Instansi</label>
            <select class="form-control" name="instansi_id">
                <option value="" selected>Pilih Instansi</option>
                @foreach ($pilihinstansi as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group ml-3">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <label>Nama Siswa</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label for="jurusan">Jurursan</label>
            <select class="form-control" name="jurusan">
                <option value="">Pilih Jurusan</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                <option value="Akuntansi Keuangan Lembaga">Akuntansi Keuangan Lembaga</option>
                <option value="Bisnis Daring Pemasaran">Bisnis Daring Pemasaran</option>
                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                <option value="Manajemen Perkantoran">Manajemen Perkantoran</option>
            </select>
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
    </form>
@endsection
