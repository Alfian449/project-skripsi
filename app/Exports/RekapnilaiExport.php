<?php

namespace App\Exports;

use App\Models\Rekapnilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapnilaiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rekapnilai::join('users', 'rekaps.user_id', '=', 'users.id')
                          ->select('users.name', 'users.kelas', 'rekaps.kedisiplinan', 'rekaps.tanggung_jawab', 'rekaps.komunikasi', 'rekaps.kerja_sama', 'rekaps.inisiatif', 'rekaps.ketekunan', 'rekaps.kreativitas')
                          ->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Nama", 'Kelas', "Kedisiplinan", "Tanggung Jawab", "Komunikasi", "Kerja Sama", "Inisiatif", "Ketekunan", "Kreativitas"];
    }
}
