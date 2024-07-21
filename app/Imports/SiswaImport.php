<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Nama file foto dari kolom 'foto'
        $foto = $row['foto'];

        // Pastikan foto ada di direktori temporary uploads
        $tempPath = public_path('uploads/temp/' . $foto);
        $newPath = public_path('uploads/fotos/' . $foto);

        if (file_exists($tempPath)) {
            // Pindahkan foto ke direktori tujuan
            rename($tempPath, $newPath);
        } else {
            $foto = null; // Atau berikan nilai default jika foto tidak ada
        }

        return new User([
            'nis' => $row['nis'],
            'username' => $row['username'],
            'name'     => $row['name'],
            'password' => bcrypt($row['password']),
            'kelas'    => $row['kelas'],
            'jenis_kelamin'    => $row['jenis_kelamin'],
            'phone'    => $row['phone'],
            'alamat'    => $row['alamat'],
            'foto'    => $row['foto'],
            'role' => 'siswa', // Pastikan ini selalu diisi 'siswa'
            'status' => 'active', // Default value
        ]);
    }
}
