@extends('layout.halguru')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Rekap Nilai</h5>
        </form>
    </nav>

    <h3 class="ml-3">Update Rekap Nilai</h3>
    <form method="POST" action="{{ route('rekapnilai.update', $rekapnilai->id) }}">
        @csrf
        @method('put')
        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $rekapnilai->user->name }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kedisiplinan</label>
            <input type="text" name="kedisiplinan" value="{{ $rekapnilai->kedisiplinan }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Tanggung Jawab</label>
            <input type="text" name="tanggung_jawab" value="{{ $rekapnilai->tanggung_jawab }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Komunikasi</label>
            <input type="text" name="komunikasi" value="{{ $rekapnilai->komunikasi }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kerja Sama</label>
            <input type="text" name="kerja_sama" value="{{ $rekapnilai->kerja_sama }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Inisiatif</label>
            <input type="text" name="inisiatif" value="{{ $rekapnilai->inisiatif }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Ketekunan</label>
            <input type="text" name="ketekunan" value="{{ $rekapnilai->ketekunan }}" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kreativitas</label>
            <input type="text" name="kreativitas" value="{{ $rekapnilai->kreativitas }}" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('rekapnilai.index') }}">Batal</a>
    </form>
@endsection
