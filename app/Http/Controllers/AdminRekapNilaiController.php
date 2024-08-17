<?php

namespace App\Http\Controllers;

use App\Models\Rekapnilai;
use Illuminate\Http\Request;

class AdminRekapNilaiController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $rekapnilai = Rekapnilai::with(['response', 'user'])->get();
        return view('admin.rekapnilai.index', compact('rekapnilai'));
    }
}
