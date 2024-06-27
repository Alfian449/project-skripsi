<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;

class SearchlogbookController extends Controller
{
    public function searchlogbook(Request $request)
    {
        $query = $request->input('query');
        $resultslogbook = Logbook::where('nama_kegiatan', 'LIKE', "%{$query}%")->get();

        return view('search.resultslogbook', compact('resultslogbook'));
    }
}
