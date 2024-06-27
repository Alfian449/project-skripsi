<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class SearchinstansiController extends Controller
{
    public function searchinstansi(Request $request)
    {
        $query = $request->input('query');
        $resultsinstansi = Instansi::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.resultsinstansi', compact('resultsinstansi'));
    }
}
