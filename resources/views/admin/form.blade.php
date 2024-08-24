{{-- @extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Admin</h5>
        </form>
    </nav>

    <h3 class="ml-3">Tambah Admin</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store') }}">
        @csrf
        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="nama" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Username</label>
            <input type="text" name="username" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Password</label>
            <input type="text" name="password" value="" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-warning" href="{{ route('admin.index') }}">Batal</a>
    </form>
@endsection --}}
