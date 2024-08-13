<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $jurusan = Jurusan::all();
        return view('admin.jurusan.jurusanindex', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan tampilan untuk membuat data guru baru.
        return view('admin.jurusan.jurusanform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat validasi untuk inputan data pengguna.
        $validasi = $request->validate(
            [
                'nama_jurusan' => 'required|unique:jurusans|max:45',
            ],
        );
        // Membuat pengguna baru dan menyimpannya di database.
        // dd($validasi);
        Jurusan::create($validasi);

        return redirect('/jurusan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect('/jurusan');
    }
}
