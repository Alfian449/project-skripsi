<?php

namespace App\Exports;

use App\Models\Rekapnilai;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapnilaiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rekapnilai::select("name", "kedisiplinan", "tanggung_jawab", "komunikasi", "kerja_sama", "inisiatif", "ketekunan", "kreativitas")->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Nama", "Kedisiplinan", "Tanggung Jawab", "Komunikasi", "Kerja Sama", "Inisiatif", "Ketekunan", "Kreativitas"];
    }
}
