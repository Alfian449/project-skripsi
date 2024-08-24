{{-- @extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Siswa</h5>
        </form>
    </nav>


    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
    @foreach ($siswa as $rs)
        <div class="card ml-3" style="width: 18rem;">
            @if (!empty($rs->foto) && file_exists(public_path('uploads/fotos/' . $rs->foto)))
                <img src="{{ asset('uploads/fotos/' . $rs->foto) }}" alt="{{ $rs->name }}" width="90" class="card-img-top">
            @else
                <img src="{{ asset('uploads/fotos/nophoto.png') }}" alt="{{ $rs->name }}" width="90" class="card-img-top">
            @endif
            <div class="card-body">
                <p class="card-text">
                    NIS : {{ $rs->nis }}<br>
                    Username : {{ $rs->username }}<br>
                    Nama : {{ $rs->name }}<br>
                    Password : {{ $rs->password }}<br>
                    Kelas : {{ $rs->kelas }}<br>
                    Jenis Kelamin : {{ $rs->jenis_kelamin }}<br>
                    Phone : {{ $rs->phone }}<br>
                    Alamat : {{ $rs->alamat }}<br>
                </p>
                <a class="btn btn-success" href="{{ route('siswa.index') }}">Kembali</a>
            </div>
        </div>
    @endforeach
    </div>
@endsection --}}
