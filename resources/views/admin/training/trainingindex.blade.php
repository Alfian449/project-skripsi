@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Ploting Prakerin</h5>
        </form>
    </nav>

    @php
        $ar_training = ['No', 'Nama Siswa', 'NIS', 'Tahun Pelajaran', 'Nama Instansi', 'Penanggung Jawab', 'Jurusan', 'Aksi'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Ploting Prakerin</h3>
    <br>

    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="d-flex flex-wrap">
                <a class="btn btn-primary ml-2 mb-2" href="{{ url('plotingprakerin-export') }}">Export To Excel</a>

                <form action="" method="get" class="form-inline">
                    <!-- Filter Instansi -->
                    <select class="form-control mr-2 mb-2 ml-2" name="p">
                        <option value="" selected>Pilih Instansi</option>
                        @foreach ($pilihinstansi as $item)
                            <option value="{{ $item->id }}" {{ request()->get('p') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Tahun Pelajaran -->
                    <select class="form-control mr-2 mb-2 ml-2" name="t">
                        <option value="" selected>Pilih Tahun Pelajaran</option>
                        @foreach ($tahunPelajaran as $tahun)
                            <option value="{{ $tahun->tahun_pelajaran }}" {{ request()->get('t') == $tahun->tahun_pelajaran ? 'selected' : '' }}>
                                {{ $tahun->tahun_pelajaran }}
                            </option>
                        @endforeach
                    </select>

                    <button class="btn btn-success mb-2 ml-2" type="submit">Filter</button>
                </form>
            </div>
        </div>

        <div class="col-lg-4 col-md-5 col-sm-12">
            <form action="{{ route('searchploting') }}" method="GET" class="form-inline">
                <input class="form-control mr-2 mb-2 ml-2" type="text" name="query" placeholder="Search for a name">
                <button class="btn btn-success mb-2 ml-2" type="submit">Search</button>
            </form>
        </div>
    </div>

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
                        <td>{{ $row->user->tahun_pelajaran }}</td>
                        <td>{{ $row->instansi->name }}</td>
                        <td>{{ $row->instansi->guru->name }}</td>
                        <td>{{ $row->user->kelas }}</td>
                        <td>
                            <!-- Status dan aksi -->
                            <div class="d-flex align-items-center">
                                <span class="mr-2">
                                    @if ($row->status == 'approved')
                                        <span class="text-success">{{ ucfirst($row->status) }}</span>
                                    @elseif($row->status == 'pending')
                                        <span class="text-warning">{{ ucfirst($row->status) }}</span>
                                    @else
                                        <span class="text-danger">{{ ucfirst($row->status) }}</span>
                                    @endif
                                </span>

                                @if ($row->status == 'pending')
                                    <form action="{{ route('training.approve', $row->id) }}" method="POST" class="mr-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('training.reject', $row->id) }}" method="POST" class="mr-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @else
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editTraining{{ $row->id }}">
                                        Edit
                                    </button>
                                @endif
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="editTraining{{ $row->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCamp">
                                                Edit Status Training {{ $row->user->name }}
                                            </h5>
                                            <button class="close" type="button" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('list-training.update', $row->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="status"> Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="approved" {{ $row->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="pending" {{ $row->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="rejected" {{ $row->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
