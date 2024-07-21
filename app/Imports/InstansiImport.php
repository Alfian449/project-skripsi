<?php

namespace App\Imports;

use App\Models\Instansi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class instansiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Instansi([
            'name' => $row['name'],
            'alamat'     => $row['alamat'],
            'phone'    => $row['phone'],
            'email'    => $row['email'],
        ]);
    }
}
