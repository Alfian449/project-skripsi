<?php

namespace App\Http\Controllers;

use App\Models\Training;

class HistoryController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $history = Training::all();
        return view('siswa.history.historyindex', compact('history'));
    }
}
