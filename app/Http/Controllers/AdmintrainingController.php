<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Training;

class AdmintrainingController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.        $pilihinstansi = Instansi::all();
        $training = Training::with(['user', 'instansi', 'instansi.guru']);
        $pilihinstansi = Instansi::all();
        if (request()->filled('p')) {
            $training->whereHas('instansi', function ($q) {
                $q->where('instansi_id', request()->p);
            });
        }
        // return $training->get();
        return view('admin.training.trainingindex', [
            'training' => $training->get(),
            'pilihinstansi' => $pilihinstansi
        ]);
    }

    public function update(Training $list_training)
    {
        // update status training approved, pending, rejected
        $list_training->update([
            'status' => request('status')
        ]);
        return back();
    }
}
