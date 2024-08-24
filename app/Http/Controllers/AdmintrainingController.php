<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Training;
use App\Models\User; // Tambahkan model User jika diperlukan

class AdmintrainingController extends Controller
{
    public function index()
    {
        $pilihinstansi = Instansi::all();
        $tahunPelajaran = User::select('tahun_pelajaran')->distinct()->get(); // Mengambil tahun pelajaran unik

        $training = Training::with(['user', 'instansi', 'instansi.guru']);

        // Filter berdasarkan instansi jika ada
        if (request()->filled('p')) {
            $training->whereHas('instansi', function ($q) {
                $q->where('instansi_id', request()->p);
            });
        }

        // Filter berdasarkan tahun pelajaran jika ada
        if (request()->filled('t')) {
            $training->whereHas('user', function ($q) {
                $q->where('tahun_pelajaran', request()->t);
            });
        }

        return view('admin.training.trainingindex', [
            'training' => $training->get(),
            'pilihinstansi' => $pilihinstansi,
            'tahunPelajaran' => $tahunPelajaran
        ]);
    }

    public function update(Training $list_training)
    {
        $list_training->update([
            'status' => request('status')
        ]);
        return back();
    }
}
