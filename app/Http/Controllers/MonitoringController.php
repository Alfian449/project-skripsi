<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $monitoring = Monitoring::all();
        return view('siswa.monitoring.monitoringindex', compact('monitoring'));
    }
}
