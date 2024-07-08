<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Logbook;

class LogbookController extends Controller
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
    public function store(Request $request, Training $training)
    {
        $validasi = $request->validate(
            [
                'user_id' => 'exists:users,id',
                'training_id' => 'exists:trainings,id',
                'keterangan' => 'required',
            ],
        );
        // Membuat pengguna baru dan menyimpannya di database.
        $validasi['user_id'] = auth()->id();
        Logbook::create($validasi);

        return redirect()->route('history.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $logbook = DB::table('logbooks')
                ->where('id', '=', $id)->get();
        return view('siswa.logbook.logbookshow', compact('logbook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $logbook = DB::table('logbooks')
        ->where('id', $id)->get();
        return view('siswa.logbook.logbookedit', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('logbooks')->where('id', $id)->update(
            [
                'nama_kegiatan'=>$request->nama_kegiatan,
                'keterangan'=>$request->keterangan,
                'tanggal'=>$request->tanggal,
            ]
        );

        return redirect('/logbook'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        $logbook->delete();

        return redirect('/history');
    }

    public function createFormLogbook(Training $training)
    {
    // return $training->load('instansi');
        return view('siswa.logbook.logbookform', compact('training'));
    }
}
