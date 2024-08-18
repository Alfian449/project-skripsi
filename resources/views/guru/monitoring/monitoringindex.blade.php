@extends('layout.halguru')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Monitoring Siswa</h5>
        </form>
    </nav>

    @php
        $ar_monitoring = ['No', 'Instansi', 'Nama Siswa', 'Tanggal', 'Keterangan','Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Monitoring Siswa</h3>
    <br>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_monitoring as $amonitoring)
                    <th scope="col">{{ $amonitoring }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($monitoring as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->training->instansi->name }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>
                        @if($row->status == 'pending')
                            <form method="POST" action="{{ route('logbook.approve', $row->id) }}">
                                @csrf
                                <button class="btn btn-success">Approve</button>
                            </form>
                        @else
                            <span class="badge badge-success">Approved</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
