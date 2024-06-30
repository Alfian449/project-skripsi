<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'user_id' => 'exists:users,id',
                'instansi_id' => 'exists:instansis,id',
                'jurusan' => 'required',
            ],
        );
        // Membuat pengguna baru dan menyimpannya di database.

        // dd($validasi);

        $validasi['user_id'] = auth()->id();

        Training::create($validasi);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        $logbook = Logbook::with(['training', 'training.instansi'])->where('training_id', $training->id)->get();
        // return $logbook;
        return view('siswa.logbook.logbookindex', compact(['logbook', 'training']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //
    }
}
