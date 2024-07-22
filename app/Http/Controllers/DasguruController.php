<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasguruController extends Controller
{
    public function dashboardGuru()
    {
    // Mendapatkan data guru yang sedang login
    $guru = auth()->user();

    // Mengirim data ke view
    return view('dashboard.indexguru', compact('guru'));
    }
}
