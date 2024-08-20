@extends('layout.app')

@section('content')
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <h5 class="h5 mb-0 text-gray-800">Halaman Pencarian Ploting Siswa</h5>
    </form>
</nav>

<div>
    <h2 class="ml-3">Data Ploting Siswa</h2>
    <nav aria-label="breadcrumb" class="ml-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/list-training') }}">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
        </ol>
    </nav>

    <div class="table-responsive">
    <div class="table-container">
        <table class="table table-striped table-hover mt-3 ml-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Nama Instansi</th>
                    <th>Penanggung Jawab</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultploting as $result)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $result->user->name }}</td>
                        <td>{{ $result->user->nis }}</td>
                        <td>{{ $result->instansi->name }}</td>
                        <td>{{ $result->instansi->guru->name }}</td>
                        <td>{{ $result->user->kelas }}</td>
                        <td>
                            @if ($result->status == 'approved')
                                <span class="text-success">{{ ucfirst($result->status) }}</span>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editTraining{{ $result->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editTraining{{ $result->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCamp">
                                                    Edit Status Training {{ $result->user->name }}
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('list-training.update', $result->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="status"> Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="approved">Approved</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="rejected">Rejected</option>
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
                            @elseif($result->status == 'pending')
                                <span class="text-warning">{{ ucfirst($result->status) }}</span>
                                <form action="{{ route('training.approve', $result->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('training.reject', $result->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @else
                                <span class="text-danger">{{ ucfirst($result->status) }}</span>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editTraining{{ $result->id }}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editTraining{{ $result->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCamp">
                                                    Edit Status Training {{ $result->user->name }}
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('list-training.update', $result->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="status"> Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="approved">Approved</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="rejected">Rejected</option>
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
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection
