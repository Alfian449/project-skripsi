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

    <h3 class="ml-3">Update Instansi</h3>
    @foreach ($instansi as $rs)
        <form method="POST" action="{{ route('instansi.update', $rs->id) }}">
            @csrf
            @method('put')
            <div class="form-group ml-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $rs->name }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $rs->alamat }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $rs->phone }}" class="form-control">
            </div>

            <div class="form-group ml-3">
                <label>Email</label>
                <input type="text" name="email" value="{{ $rs->email }}" class="form-control">
            </div>

            <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
            <a class="btn btn-warning" href="{{ route('instansi.index') }}">Batal</a>
        </form>
    @endforeach
@endsection
