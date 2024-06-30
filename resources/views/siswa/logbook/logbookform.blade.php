@extends('layout.halsiswa')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">LogBook Kegiatan</h5>
        </form>
    </nav>

    <h3 class="ml-3">Tambah LogBook</h3>
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
        <input type="hidden" name="training_id" value="{{ $training->id }}">
        @csrf
        <div class="form-group ml-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" placeholder="apa kegiatanmu hari ini"></textarea>
        </div>
        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-warning" href="{{ route('logbook.index') }}">Batal</a>
    </form>
@endsection
