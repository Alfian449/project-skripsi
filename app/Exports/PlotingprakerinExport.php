<?php

namespace App\Exports;

use App\Models\Training;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlotingprakerinExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data dari model Training beserta relasi user dan instansi
        return Training::with('user', 'instansi')
            ->get()
            ->map(function($training) {
                return [
                    'Nama Siswa' => $training->user->name,
                    'NIS' => $training->user->nis,
                    'Nama Instansi' => $training->instansi->name,
                    'Penanggung Jawab' => $training->instansi->guru->name,
                    'Kelas' => $training->user->kelas,
                    'Status' => $training->status
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ["Nama Siswa", 'NIS', "Nama Instansi", "Penanggung Jawab", 'Kelas', "Status"];
    }
}
