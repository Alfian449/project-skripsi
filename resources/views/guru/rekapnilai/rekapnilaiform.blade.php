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

    <h3 class="ml-3">Tambah Rekap Nilai</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('rekapnilai.store') }}">
        @csrf
        <div class="form-group ml-3">
            <label>Nama</label>
            <input type="text" name="name" value="" class="form-control" >
        </div>

        {{-- <div class="form-group ml-3">
            <label>Kelas</label>
            <input type="text" name="kelas" value="" class="form-control" >
        </div> --}}

        <div class="form-group ml-3">
            <label>Kedisiplinan</label>
            <input type="text" name="kedisiplinan" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Tanggung Jawab</label>
            <input type="text" name="tanggung_jawab" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Komunikasi</label>
            <input type="text" name="komunikasi" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kerja Sama</label>
            <input type="text" name="kerja_sama" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Inisiatif</label>
            <input type="text" name="inisiatif" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Ketekunan</label>
            <input type="text" name="ketekunan" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kreativitas</label>
            <input type="text" name="kreativitas" value="" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('rekapnilai.index') }}">Batal</a>
    </form>
@endsection
