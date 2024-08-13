@extends('layout.app')

@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman jurusan</h5>
        </form>
    </nav>

    @php
        $ar_jurusan = ['No', 'Jurusan', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Jurusan</h3>
    <br>

    <div class="row">
        <!-- Bagian Kiri: Tambah, Export, dan Import -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="d-flex flex-wrap">
                <a class="btn btn-primary mb-2 ml-2" href="{{ route('jurusan.create') }}">Tambah</a>
            </div>
        </div>
    </div>

    <!-- Tabel Data Guru -->
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3 ml-3">
            <thead class="thead-light">
                <tr>
                    @foreach ($ar_jurusan as $ajurusan)
                        <th scope="col">{{ $ajurusan }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusan as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nama_jurusan }}</td>
                        <td>
                            <div class="d-flex flex-column flex-md-row">
                                <form method="POST" action="{{ route('jurusan.destroy', $row->id) }}" onsubmit="return confirm('Apakah Anda Yakin Data Dihapus?')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
