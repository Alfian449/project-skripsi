<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Memfilter data berdasarkan role 'siswa'
        return User::select("nis", 'username', "name", "kelas", "jenis_kelamin", "phone", 'tahun_pelajaran', "alamat", "foto")
                    ->where('role', 'siswa')
                    ->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["NIS", 'Username', "Name", "Kelas", "Jenis Kelamin", "Phone", 'Tahun Pelajaran', "Alamat", "Foto"];
    }
}
