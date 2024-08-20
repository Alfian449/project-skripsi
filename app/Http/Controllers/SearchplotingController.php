<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class SearchplotingController extends Controller
{
    public function searchploting(Request $request)
    {
        $query = $request->input('query');

        // Join tabel 'users' dan cari berdasarkan nama siswa
        $resultploting = Training::whereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })->get();

        return view('search.resultploting', compact('resultploting'));
    }
}
