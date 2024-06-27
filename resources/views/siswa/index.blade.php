@extends('layout.halsiswa')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Pilih Instansi</h5>
        </form>

        <!-- Topbar Navbar -->


    </nav>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Data Instansi</title>
    </head>

    <body>
        <h1 class="ml-3">Data Instansi</h1>
        <div class="d-flex align-items-center ml-3">
            <label for="entriesSelect" class="mr-2 mb-0"> Jurusan </label>
            <select id="entriesSelect" class="form-control d-inline-block" style="width: auto;">
                <option value="">-- Pilih Jurusan Anda --</option>
                <option value="rpl">Rekayasa Perangkat Lunak</option>
                <option value="mm">Multimedia</option>
                <option value="ak">Akuntansi</option>
                <option value="tkj">Teknik Komputer Jaringan</option>
            </select>
        </div>
        <table class="table table-striped mt-3 ml-3">
            <thead>
                <tr>
                    <th>Nama Instansi</th>
                    <th>Alamat Instansi</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($instansis as $instansi)
                    <tr>
                        <td>{{ $instansi->nama }}</td>
                        <td>{{ $instansi->alamat }}</td>
                        <td>{{ $instansi->phone }}</td>
                        <td>{{ $instansi->email }}</td>
                        <td>
                            <button type="submit" name="pilih" class="btn btn-primary">Pilih</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </body>

    </html>
@endsection

{{-- <h1>Data Instansi</h1>

<ul>
    @foreach ($instansis as $instansi)
        <li>{{ $instansi->nama }}</li>
        <li>{{ $instansi->alamat }}</li>
        <li>{{ $instansi->phone }}</li>
        <li>{{ $instansi->email }}</li>
    @endforeach
</ul> --}}
