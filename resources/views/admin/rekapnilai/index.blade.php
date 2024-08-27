@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Rekap Nilai</h5>
        </form>
    </nav>

    @php
    $ar_rekapnilai = [
        'No',
        'Nama Siswa',
        'Kelas',
        'Nama Instansi',  // Kolom Nama Instansi
        'Tahun Pelajaran',  // Kolom Tahun Pelajaran yang baru ditambahkan
        'Kedisiplinan',
        'Tanggung Jawab',
        'Komunikasi',
        'Kerja Sama',
        'Inisiatif',
        'Ketekunan',
        'Kreativitas',
    ];
    $no = 1;
@endphp

    <h3 class="ml-3">Data Rekap Nilai</h3>
    <br>

    <div class="row mb-3">
        <!-- Bagian Kiri: Export Button -->
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex">
            <a class="btn btn-success ml-3" href="{{ url('rekapnilai-export') }}">Export To Excel</a>
        </div>

        <!-- Bagian Kanan: Search Form -->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <form action="{{ route('searchrekapnilai') }}" method="GET" class="form-inline justify-content-end" style="margin-right: 50px;">
                <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
        <table class="table table-striped mt-3 ml-3">
            <thead>
                <tr>
                    @foreach ($ar_rekapnilai as $arekapnilai)
                        <th scope="col">{{ $arekapnilai }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapnilai as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->user->name }}</td>
                        <td>{{ $row->user->kelas }}</td>
                        <td>
                            @if ($row->user->trainings->first() && $row->user->trainings->first()->instansi)
                                {{ $row->user->trainings->first()->instansi->name }}
                            @else
                                Tidak ada instansi
                            @endif
                        </td>
                        <td>{{ $row->user->tahun_pelajaran }}</td> <!-- Kolom Tahun Pelajaran -->
                        <td>{{ $row->kedisiplinan }}</td>
                        <td>{{ $row->tanggung_jawab }}</td>
                        <td>{{ $row->komunikasi }}</td>
                        <td>{{ $row->kerja_sama }}</td>
                        <td>{{ $row->inisiatif }}</td>
                        <td>{{ $row->ketekunan }}</td>
                        <td>{{ $row->kreativitas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
