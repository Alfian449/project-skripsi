<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;

class DasadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil total siswa
        $totalSiswa = User::where('role', 'siswa')->count();

        // Mengambil total guru
        $totalGuru = User::where('role', 'guru')->count();

        // Mengambil total instansi
        $totalInstansi = Instansi::count();

        $plotingPrakerin = User::where('role', 'siswa')
                               ->where('status', 'pending') // Ganti 'status' sesuai dengan kolom yang ada
                               ->count();

        // Mengirim data ke view
        return view('dashboard.index', compact('totalSiswa', 'totalGuru', 'totalInstansi', 'plotingPrakerin'));
    }
}
