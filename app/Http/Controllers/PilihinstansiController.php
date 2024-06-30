<?php

namespace App\Http\Controllers;

use App\Models\Pilihinstansi;
use Illuminate\Http\Request;

class PilihinstansiController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $pilihinstansi = Pilihinstansi::all();
        return view('siswa.instansi.pilihinstansi', compact('pilihinstansi'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nis' => 'required|unique:pilihinstansi|',
                'name' => 'required',
                'jurusan' => 'required',
            ],

            [
                'nis.required' => 'NIS wajib diisi',
                'nis.unique' => 'NIS tidak boleh sama',
                'name.required' => 'Nama wajib diisi',
                'jurusan.required' => ' Jurusan Wajib diisi.',
            ],
        );
        // Membuat pengguna baru dan menyimpannya di database.
        Pilihinstansi::create($validasi);

        return redirect('/pilihinstansi');
    }
}
