<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $user = Auth::user();
        $history = Training::where('user_id', $user->id)->with('instansi')->latest()->first();
        // return $history;
        return view('siswa.history.historyindex', compact('history'));
    }
}
