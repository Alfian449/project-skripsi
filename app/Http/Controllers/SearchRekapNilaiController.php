<?php

namespace App\Http\Controllers;

use App\Models\RekapNilai;
use Illuminate\Http\Request;

class SearchRekapNilaiController extends Controller
{
    public function searchrekapnilai(Request $request)
    {
        $query = $request->input('query');

        // Melakukan pencarian berdasarkan nama siswa
        $resultRekapNilai = RekapNilai::whereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })->get();

        return view('search.resultrekapnilai', compact('resultRekapNilai'));
    }
}

