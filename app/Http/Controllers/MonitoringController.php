<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Logbook;
use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // ambil data monitoring guru, berdasarkan user yang isi logbook dari guru yang bertanggung jawab pada instansi tersebut.
        $guruId = auth()->id();
        $monitoring = Logbook::with(['user', 'training', 'training.instansi'])->whereHas('training.instansi', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })->get();
        // return $monitoring;
        return view('guru.monitoring.monitoringindex', compact('monitoring'));
    }
}
