<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
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
        $tempPath = public_path('uploads/guru/' . $foto);
        $newPath = public_path('uploads/gurus/' . $foto);

        if (file_exists($tempPath)) {
            // Pindahkan foto ke direktori tujuan
            rename($tempPath, $newPath);
        } else {
            $foto = null; // Atau berikan nilai default jika foto tidak ada
        }
        return new User([
            'username'     => $row['username'],
            'name'     => $row['name'],
            'password' => bcrypt($row['password']),
            'jenis_kelamin'    => $row['jenis_kelamin'],
            'phone'    => $row['phone'],
            'alamat'    => $row['alamat'],
            'foto'    => $row['foto'],
            'role' => 'guru', // Pastikan ini selalu diisi 'guru'
            'status' => 'active', // Default value
        ]);
    }
}
