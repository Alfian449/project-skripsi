<?php

namespace App\Http\Controllers;

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
        $logbook = Logbook::all();
        return view('siswa.logbook.logbookindex', compact('logbook'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.logbook.logbookform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama_kegiatan' => 'required|unique:logbooks|',
                'keterangan' => 'required|',
                'tanggal' => 'required|date',
            ],

            [
                'nama_kegiatan.required' => 'Nama wajib diisi',
                'nama_kegiatan.unique' => 'Nama tidak boleh sama',
                'keterangan.required' => 'Keterangan wajib diisi',
                'tanggal.required' => ' Tanggal Wajib diisi.',
                'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
            ],
        );
        // Membuat pengguna baru dan menyimpannya di database.
        Logbook::create($validasi);

        return redirect('/logbook');
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
    public function destroy(string $id)
    {
        DB::table('logbooks')->where('id', $id)->delete();

        return redirect('/logbook');
    }
}
