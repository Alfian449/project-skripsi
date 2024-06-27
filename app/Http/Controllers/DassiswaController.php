<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DassiswaController extends Controller
{
    public function index()
    {
        return view('dashboard.indexsiswa');
    }
}
