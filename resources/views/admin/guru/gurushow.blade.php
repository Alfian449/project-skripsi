{{-- @extends('layout.app')

@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Guru</h5>
        </form>
    </nav>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
        @foreach ($guru as $guru)
            <div class="card ml-3" style="width: 18rem;">
                @if (!empty($guru->foto) && file_exists(public_path('uploads/gurus/' . $guru->foto)))
                    <img src="{{ asset('uploads/gurus/' . $guru->foto) }}" alt="{{ $guru->name }}" width="90"
                        class="card-img-top">
                @else
                    <img src="{{ asset('uploads/gurus/nophoto.png') }}" alt="{{ $guru->name }}" width="90"
                        class="card-img-top">
                @endif
                <div class="card-body">
                    <p class="card-text">
                        NIP : {{ $guru->nip }}<br>
                        Username : {{ $guru->username }}<br>
                        Nama : {{ $guru->name }}<br>
                        Password : {{ $guru->password }}<br>
                        Jenis Kelamin : {{ $guru->jenis_kelamin }}<br>
                        Phone : {{ $guru->phone }}<br>
                        Alamat : {{ $guru->alamat }}<br>
                    </p>
                    <a class="btn btn-success" href="{{ route('guru.index') }}">Kembali</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection --}}
