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

    @php
        $ar_logbook = ['No', 'Nama Instansi', 'Keterangan', 'Tanggal', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Logbook Kegiatan ( {{ $training->instansi->name }} )</h3>
    <span class="ml-3">Penanggung Jawab : <b>{{ $training->instansi->guru->name }}</b></span>
    <br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a class="btn btn-primary ml-3" href="{{ route('logbook.createFormLogbook', $training->id) }}">Tambah</a>
        {{-- <form action="{{ route('searchlogbook') }}" method="GET" class="form-inline">
            <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
            <button class="btn btn-success" type="submit">Search</button>
        </form> --}}
    </div>

    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_logbook as $alogbook)
                    <th scope="col">{{ $alogbook }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($logbook as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->training->instansi->name }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>{{ $row->created_at->format('d F Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('logbook.destroy', $row->id) }}">
                            @csrf
                            @method('delete')
                            {{-- <a class="btn btn-success" href="{{ route('logbook.edit', $row->id) }}">Edit</a>
                            <a class="btn btn-info" href="{{ route('logbook.show', $row->id) }}">Detail</a> --}}
                            <button class="btn btn-danger"
                                onclick="return confirm('Apakah Anda Yakin Data Dihapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger">
                    Data Logbook Kegiatan Belum Tersedia
                </div>
            @endforelse
        </tbody>
    </table>
@endsection
