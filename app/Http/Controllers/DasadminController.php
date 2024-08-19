<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Rekapnilai;
use App\Models\Training;
use Illuminate\Http\Request;

class DasadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalInstansi = Instansi::count();
        $plotingPrakerin = Training::where('status', 'pending')->count();
        $totalRekapnilai = Rekapnilai::count();
        $totalJurusan = Jurusan::count();

        return view('dashboard.index', compact('totalSiswa', 'totalGuru', 'totalInstansi', 'plotingPrakerin', 'totalRekapnilai', 'totalJurusan'));
    }
}
