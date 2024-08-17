@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman List Training</h5>
        </form>
    </nav>

    @php
        $ar_training = ['No', 'Nama Siswa', 'NIS', 'Nama Instansi', 'Penanggung Jawab', 'Jurusan', 'Status', 'Aksi'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data List Training</h3>
    <br>

    <div class="row">
        <!-- Bagian Kiri: Tambah, Export, dan Import -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="d-flex flex-wrap">
                <a class="btn btn-primary ml-2 mb-2" href="{{ url('siswasi-export') }}">Export To Excel</a>
            </div>
        </div>

        <!-- Bagian Kanan: Pencarian -->
        <div class="col-lg-4 col-md-5 col-sm-12">
            <form action="{{ route('searchploting') }}" method="GET" class="form-inline">
                <input class="form-control mr-2 mb-2 ml-2" type="text" name="query" placeholder="Search for a name">
                <button class="btn btn-success mb-2 ml-2" type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
        <table class="table table-striped mt-3 ml-3">
            <thead>
                <tr>
                    @foreach ($ar_training as $atraining)
                        <th scope="col">{{ $atraining }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($training as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->user->name }}</td>
                        <td>{{ $row->user->nis }}</td>
                        <td>{{ $row->instansi->name }}</td>
                        <td>{{ $row->instansi->guru_id }}</td>
                        <td>{{ $row->jurusan }}</td>
                        <td>{{ $row->status }}</td>
                        <td>
                            @if($row->status == 'pending')
                                <form action="{{ route('training.approve', $row->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form action="{{ route('training.reject', $row->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                                <a href="{{ route('training.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            @else
                                {{ ucfirst($row->status) }}
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
