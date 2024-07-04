<?php

namespace App\Http\Controllers;

use App\Exports\InstansiExport;
use App\Imports\InstansiImport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Instansi;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $instansis = Instansi::all();
        return view('admin.instansi.instansiindex', compact('instansis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pilihpenanggungjawab = User::where('role', 'guru')->get();
        // Menampilkan tampilan untuk membuat data pengguna baru.
        return view('admin.instansi.instansiform', compact('pilihpenanggungjawab'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat validasi untuk inputan data pengguna.
        $validasi = $request->validate(
            [
                'name' => 'required|unique:instansis|max:45',
                'alamat' => 'required|max:45',
                'phone' => 'required|max:45',
                'email' => 'required|email|max:45',
                'guru_id' => 'exists:users,id'
            ],

            [
                'name.required' => 'Nama wajib diisi',
                'name.unique' => 'Nama tidak boleh sama',
                'alamat.required' => 'Alamat wajib diisi',
                'phone.required' => 'Nomor HP Wajib diisi.',
                'email.required' => 'Email Wajib diisi.',
            ],
        );
        // Membuat pengguna baru dan menyimpannya di database.
        $validasi['guru_id'] = $request->guru_id;
        // dd($validasi);
        Instansi::create($validasi);

        return redirect('/instansi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan data pengguna berdasarkan ID.
        $instansi = DB::table('instansis')
                ->where('id', '=', $id)->get();
        return view('admin.instansi.instansishow', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan data pengguna berdasarkan ID untuk diedit.
        $pilihpenanggungjawab = Instansi::where('id', $id)->get();
        return view('admin.instansi.instansiedit', compact('pilihpenanggungjawab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update data instansi
        DB::table('instansis')->where('id', $id)->update(
            [
                'name'=>$request->name,
                'alamat'=>$request->alamat,
                'phone'=>$request->phone,
                'email'=>$request->email,
            ]
        );

        return redirect('/instansi'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data instansi berdasarkan ID.
        DB::table('instansis')->where('id', $id)->delete();

        return redirect('/instansi');
    }
}
