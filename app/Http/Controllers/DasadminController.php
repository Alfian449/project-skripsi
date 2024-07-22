<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
