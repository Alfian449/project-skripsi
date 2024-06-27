<?php

namespace App\Imports;

use App\Models\Siswa;
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
        return new User([
            'nis' => $row['nis'],
            'name'     => $row['name'],
            'kelas'    => $row['kelas'],
            'jenis_kelamin'    => $row['jenis_kelamin'],
            'phone'    => $row['phone'],
            'alamat'    => $row['alamat'],
            'foto'    => $row['foto'],
        ]);
    }
}
