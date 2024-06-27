<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchguruController extends Controller
{
    public function searchguru(Request $request)
    {
        $query = $request->input('query');
        $resultsguru = User::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.resultsguru', compact('resultsguru'));
    }
}
