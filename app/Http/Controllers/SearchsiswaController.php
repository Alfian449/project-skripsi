<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchsiswaController extends Controller
{
    public function searchsiswa(Request $request)
    {
        $query = $request->input('query');
        $resultssiswa = User::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.resultssiswa', compact('resultssiswa'));
    }
}
