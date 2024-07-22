<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DassiswaController extends Controller
{
    public function dashboardSiswa()
    {
    // Mendapatkan data guru yang sedang login
    $siswa = auth()->user();

    // Mengirim data ke view
    return view('dashboard.indexsiswa', compact('siswa'));
    }
}
