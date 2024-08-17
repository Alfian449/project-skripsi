<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class SearchplotingController extends Controller
{
    public function searchploting(Request $request)
    {
        $query = $request->input('query');
        $resultploting = Training::where('user_id', 'LIKE', "%{$query}%")->get();

        return view('search.resultploting', compact('resultploting'));
    }
}
