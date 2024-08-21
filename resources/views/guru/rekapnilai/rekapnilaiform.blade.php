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

    <!-- Tombol untuk membuka modal -->
    <div class="ml-3 mb-4">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal">
            Lihat Informasi Pengisian Nilai
        </button>
    </div>

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
            <select name="user_id" class="form-control">
                <option value="">-- Pilih Siswa --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group ml-3">
            <label>Kedisiplinan</label>
            <input type="number" name="kedisiplinan" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Tanggung Jawab</label>
            <input type="number" name="tanggung_jawab" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Komunikasi</label>
            <input type="number" name="komunikasi" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kerja Sama</label>
            <input type="number" name="kerja_sama" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Inisiatif</label>
            <input type="number" name="inisiatif" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Ketekunan</label>
            <input type="number" name="ketekunan" value="" class="form-control">
        </div>

        <div class="form-group ml-3">
            <label>Kreativitas</label>
            <input type="number" name="kreativitas" value="" class="form-control">
        </div>

        <button type="submit" name="proses" class="btn btn-primary ml-3">Simpan</button>
        <a class="btn btn-success" href="{{ route('rekapnilai.index') }}">Batal</a>
    </form>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Informasi Pengisian Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Petunjuk Pengisian:</strong></p>
                    <ul>
                        <li>Nilai harus diisi dengan angka.</li>
                        <li>Rentang nilai:</li>
                        <ul>
                            <li>10-20: Sangat Tidak Baik</li>
                            <li>20-40: Tidak Baik</li>
                            <li>40-60: Cukup</li>
                            <li>60-80: Baik</li>
                            <li>80-100: Sangat Baik</li>
                        </ul>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
