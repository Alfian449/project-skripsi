<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Memfilter data berdasarkan role 'siswa'
        return User::select('username', "name", "jenis_kelamin", "phone", "alamat", "foto")
                    ->where('role', 'guru')
                    ->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Username", "Nama", "Jenis Kelamin", "Phone", "Alamat", "Foto"];
    }
}
