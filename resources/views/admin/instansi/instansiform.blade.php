@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Instansi</h5>
        </form>
    </nav>

    <h3 class="ml-3">Tambah Instansi</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('instansi.store') }}">
        @csrf
        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="" class="form-control" placeholder="Masukkan Nama Instansi">
        </div>

        <div class="form-group ml-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="" class="form-control" placeholder="Masukkan Alamat Instansi">
        </div>

        <div class="form-group ml-3">
            <label>Phone</label>
            <input type="text" name="phone" value="" class="form-control" placeholder="Masukkan No HP Instansi">
        </div>

        <div class="form-group ml-3">
            <label>Email</label>
            <input type="email" name="email" value="" class="form-control" placeholder="Masukkan Email Instansi">
        </div>

        <div class="form-group ml-3">
            <label>Penanggung Jawab</label>
            <select class="form-control" name="guru_id">
                <option value="" selected>Pilih Penanggung Jawab</option>
                @foreach ($pilihpenanggungjawab as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('instansi.index') }}">Batal</a>
    </form>
@endsection
