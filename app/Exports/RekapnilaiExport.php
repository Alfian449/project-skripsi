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
                          ->leftJoin('trainings', 'users.id', '=', 'trainings.user_id')
                          ->leftJoin('instansis', 'trainings.instansi_id', '=', 'instansis.id')
                          ->select(
                              'users.name',
                              'users.kelas',
                              'instansis.name as nama_instansi', // Tambahkan kolom Nama Instansi
                              'users.tahun_pelajaran',          // Tambahkan kolom Tahun Pelajaran
                              'rekaps.kedisiplinan',
                              'rekaps.tanggung_jawab',
                              'rekaps.komunikasi',
                              'rekaps.kerja_sama',
                              'rekaps.inisiatif',
                              'rekaps.ketekunan',
                              'rekaps.kreativitas'
                          )
                          ->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            "Nama",
            "Kelas",
            "Nama Instansi",    // Tambahkan heading untuk Nama Instansi
            "Tahun Pelajaran",  // Tambahkan heading untuk Tahun Pelajaran
            "Kedisiplinan",
            "Tanggung Jawab",
            "Komunikasi",
            "Kerja Sama",
            "Inisiatif",
            "Ketekunan",
            "Kreativitas"
        ];
    }
}
