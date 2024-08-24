{{-- @extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Admin</h5>
        </form>
    </nav>

    @php
        $ar_admin = ['No', 'Nama', 'Username', 'Password', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Admin</h3>
    <br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a class="btn btn-primary ml-3" href="{{ route('admin.create') }}">Tambah</a>
        <form action="{{ route('search') }}" method="GET" class="form-inline mr-3">
            <input class="form-control mr-2" type="text" name="query" placeholder="Search for a name">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>

    <div class="d-flex align-items-center ml-3">
        <label for="entriesSelect" class="mr-2 mb-0">Show</label>
        <select id="entriesSelect" class="form-control d-inline-block" style="width: auto;">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="ml-2">entries</span>
    </div>

    <table class="table table-striped mt-3 ml-3">
        <thead>
            <tr>
                @foreach ($ar_admin as $aadmin)
                    <th scope="col">{{ $aadmin }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($admin as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->password }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.destroy', $row->id_admin) }}">
                            @csrf
                            @method('delete')
                            <a class="btn btn-success" href="{{ route('admin.edit', $row->id_admin) }}">Edit</a>
                            <a class="btn btn-info" href="{{ route('admin.show', $row->id_admin) }}">Detail</a>
                            <button class="btn btn-danger"
                                onclick="return confirm('Apakah Anda Yakin Data Dihapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection --}}
