@extends('layout.app')

@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <h5 class="h5 mb-0 text-gray-800">Halaman Siswa</h5>
        </form>
    </nav>

    @php
        $ar_siswa = ['No', 'NIS', 'Username', 'Nama', 'Kelas', 'Jenis Kelamin', 'Phone', 'Tahun Pelajaran', 'Alamat', 'Foto', 'Action'];
        $no = 1;
    @endphp

    <h3 class="ml-3">Data Siswa</h3>
    <br>

    <div class="row">
        <!-- Bagian Kiri: Tambah, Export, dan Import -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="d-flex flex-wrap">
                <a class="btn btn-primary mb-2 ml-2" href="{{ route('siswa.create') }}">Tambah</a>
                <a class="btn btn-primary ml-2 mb-2" href="{{ url('siswasi-export') }}">Export To Excel</a>
            </div>
            <form action="{{ route('siswasi.import') }}" method="POST" enctype="multipart/form-data"
                class="d-flex flex-column">
                @csrf
                <input type="file" name="file" class="form-control mt-2 col-lg-4 col-md-6 col-sm-12 ml-2">
                <button class="btn btn-success mt-2 col-lg-4 col-md-6 col-sm-12 ml-2">Import Data Siswa</button>
            </form>
        </div>

        <!-- Bagian Kanan: Pencarian -->
        <div class="col-lg-4 col-md-5 col-sm-12">
            <form action="{{ route('searchsiswa') }}" method="GET" class="form-inline">
                <input class="form-control mr-2 mb-2 ml-2" type="text" name="query" placeholder="Search for a name">
                <button class="btn btn-success mb-2 ml-2" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <button id="delete-selected" class="btn btn-danger ml-2">Hapus Data Yang Dipilih</button>
        </div>
    </div>

    <!-- Tambahkan div pembungkus untuk scrollbar horizontal -->
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3 ml-3">
            <thead class="thead-light">
                <tr>
                    <th scope="col"><input type="checkbox" id="select-all-checkbox"></th>
                    @foreach ($ar_siswa as $asiswa)
                        <th scope="col">{{ $asiswa }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $row)
                    <tr>
                        <td><input type="checkbox" class="select-item" value="{{ $row->id }}"></td>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nis }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->kelas }}</td>
                        <td>{{ $row->jenis_kelamin }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->tahun_pelajaran }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>
                            @if (!empty($row->foto) && file_exists(public_path('uploads/fotos/' . $row->foto)))
                                <img src="{{ asset('uploads/fotos/' . $row->foto) }}" alt="{{ $row->name }}"
                                    width="90">
                            @else
                                <img src="{{ asset('uploads/fotos/nophoto.png') }}" alt="{{ $row->name }}"
                                    width="90">
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column flex-md-row">
                                <a class="btn btn-success mb-1 mr-md-1" href="{{ route('siswa.edit', $row->id) }}">Edit</a>
                                <button class="btn btn-info mb-1 mr-md-1 detail-btn" data-id="{{ $row->id }}"
                                    data-toggle="modal" data-target="#detailModal">Detail</button>
                                <form method="POST" action="{{ route('siswa.destroy', $row->id) }}"
                                    onsubmit="return confirm('Apakah Anda Yakin Data Dihapus?')">
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

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <!-- Data siswa akan diisi melalui JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.detail-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const siswaId = this.getAttribute('data-id');

                    // Fetch data siswa
                    fetch(`/siswa/${siswaId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Tambahkan ini untuk memeriksa data
                            const modalContent = `
            <p><strong>NIS:</strong> ${data.nis}</p>
            <p><strong>Username:</strong> ${data.username}</p>
            <p><strong>Nama:</strong> ${data.name}</p>
            <p><strong>Kelas:</strong> ${data.kelas}</p>
            <p><strong>Jenis Kelamin:</strong> ${data.jenis_kelamin}</p>
            <p><strong>Phone:</strong> ${data.phone}</p>
            <p><strong>Tahun Pelajaran:</strong> ${data.tahun_pelajaran}</p>
            <p><strong>Alamat:</strong> ${data.alamat}</p>
            <img src="${data.foto ? '/uploads/fotos/' + data.foto : '/uploads/fotos/nophoto.png'}" alt="${data.name}" width="150">
        `;
                            document.getElementById('modal-body-content').innerHTML =
                                modalContent;
                        })
                        .catch(error => console.error('Error fetching data:', error));

                });
            });
        });

        document.getElementById('select-all-checkbox').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
        });

        document.getElementById('delete-selected').addEventListener('click', function() {
            const selected = Array.from(document.querySelectorAll('.select-item:checked')).map(cb => cb.value);
            if (selected.length > 0) {
                if (confirm('Apakah Anda yakin ingin menghapus data siswa yang dipilih?')) {
                    fetch('{{ route('siswas.massDelete') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                ids: selected
                            })
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Terjadi kesalahan saat menghapus data.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else {
                alert('Pilih setidaknya satu siswa untuk dihapus.');
            }
        });
    </script>
@endsection
