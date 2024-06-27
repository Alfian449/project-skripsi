<?php

namespace App\Imports;

use App\Models\Guru;
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
        return new Guru([
            'nama'     => $row['nama'],
            'jenis_kelamin'    => $row['jenis_kelamin'],
            'phone'    => $row['phone'],
            'alamat'    => $row['alamat'],
            'foto'    => $row['foto'],
        ]);
    }
}
