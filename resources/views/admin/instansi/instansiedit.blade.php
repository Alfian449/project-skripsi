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
    <form method="POST" action="{{ route('instansi.update', $instansi->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $instansi->name }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $instansi->alamat }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $instansi->phone }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $instansi->email }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Penanggung Jawab</label>
            <select name="guru_id" class="form-control">
                @foreach ($pilihpenanggungjawab as $guru)
                    <option value="{{ $guru->id }}" {{ $instansi->guru_id == $guru->id ? 'selected' : '' }}>
                        {{ $guru->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('instansi.index') }}">Batal</a>
    </form>
@endsection
