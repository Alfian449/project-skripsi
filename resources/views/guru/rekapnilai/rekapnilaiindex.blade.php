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

    @php
        $ar_rekapnilai = ['No', 'Nama Siswa', 'Kedisiplinan', 'Tanggung Jawab', 'Komunikasi', 'Kerja Sama', 'Inisiatif', 'Ketekunan', 'Kreativitas', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Rekap Nilai</h3>
    <br>
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <div class="d-flex">
                <a class="btn btn-primary ml-3" href="{{ route('rekapnilai.create') }}">Tambah</a>
                {{-- <a class="btn btn-success ml-3" href="{{ route('siswasi.export') }}">Export to Excel</a> --}}
            </div>
            {{-- <div class="mt-2 ml-3">
                <form action="{{ route('siswasi.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xls,.xlsx" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary">Import Excel</button>
                </form>
            </div> --}}
        </div>
        <form action="{{ route('searchsiswa') }}" method="GET" class="form-inline">
            <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>

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
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->kedisiplinan }}</td>
                    <td>{{ $row->tanggung_jawab }}</td>
                    <td>{{ $row->komunikasi }}</td>
                    <td>{{ $row->kerja_sama }}</td>
                    <td>{{ $row->inisiatif }}</td>
                    <td>{{ $row->ketekunan }}</td>
                    <td>{{ $row->kreativitas }}</td>
                    <td>
                        <form method="POST" action="{{ route('rekapnilai.destroy', $row->id) }}">
                            @csrf
                            @method('delete')
                            <a class="btn btn-success" href="{{ route('rekapnilai.edit', $row->id) }}">Edit</a>
                            <button class="btn btn-danger"
                                onclick="return confirm('Apakah Anda Yakin Data Dihapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
