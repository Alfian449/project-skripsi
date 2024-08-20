@extends('layout.halguru')

@section('content')
    <style>
        /* CSS untuk merapikan tampilan kolom "Tanggung Jawab" dan "Kerja Sama" */
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            white-space: nowrap;
        }

        .table td {
            white-space: nowrap;
        }

        .btn {
            white-space: nowrap;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .ml-3 {
            margin-left: 1rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }
    </style>

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Navbar content -->
    </nav>

    @php
        $ar_rekapnilai = [
            'No',
            'Nama Siswa',
            'Kelas',
            'Kedisiplinan',
            'Tanggung Jawab',
            'Komunikasi',
            'Kerja Sama',
            'Inisiatif',
            'Ketekunan',
            'Kreativitas',
            'Action',
        ];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Rekap Nilai</h3>
    <br>
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex">
            <a class="btn btn-primary ml-3" href="{{ route('rekapnilai.create') }}">Tambah</a>
        </div>
    </div>

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
                        <td>{{ $row->kedisiplinan }}</td>
                        <td>{{ $row->tanggung_jawab }}</td>
                        <td>{{ $row->komunikasi }}</td>
                        <td>{{ $row->kerja_sama }}</td>
                        <td>{{ $row->inisiatif }}</td>
                        <td>{{ $row->ketekunan }}</td>
                        <td>{{ $row->kreativitas }}</td>
                        <td>
                            <div class="d-flex flex-column flex-md-row">
                            <a class="btn btn-success mb-1 mr-md-1" href="{{ route('rekapnilai.edit', $row->id) }}">Edit</a>
                            <form method="POST" action="{{ route('rekapnilai.destroy', $row->id) }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda Yakin Data Dihapus?')">Hapus</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
