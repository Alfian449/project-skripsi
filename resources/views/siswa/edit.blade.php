{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Siswa</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="dashboard">
        <h1>Edit Profil Siswa</h1>
        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" required>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="{{ $siswa->kelas }}" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" @if ($siswa->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                <option value="Perempuan" @if ($siswa->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
            </select>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ $siswa->phone }}" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="{{ $siswa->alamat }}" required>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>

</html> --}}
