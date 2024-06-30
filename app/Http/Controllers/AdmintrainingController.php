<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class AdmintrainingController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $training = Training::all();
        return view('admin.training.trainingindex', compact('training'));
    }
}
