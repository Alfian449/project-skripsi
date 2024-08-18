<?php

namespace App\Http\Controllers;

use App\Imports\instansiImport;
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

    public function import()
    {
        Excel::import(new instansiImport,request()->file('file'));
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pilihpenanggungjawab = User::where('role', 'guru')->get();
        return view('admin.instansi.instansiform', compact('pilihpenanggungjawab'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validasi = $request->validate([
        'name' => 'required|unique:instansis|max:45',
        'alamat' => 'required|max:255',
        'phone' => 'required|max:45',
        'email' => 'required|email|max:45',
        'bidang' => 'required|max:45',
        'kuota' => 'required|integer|min:0', // Validasi kuota
        'guru_id' => 'exists:users,id'
    ]);

    // dd($validasi);  // Debugging untuk memeriksa data yang akan disimpan

    $validasi['guru_id'] = $request->guru_id;
    Instansi::create($validasi);

    return redirect('/instansi');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instansi = DB::table('instansis')
                ->where('id', '=', $id)->get();
        return view('admin.instansi.instansishow', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $instansi = Instansi::findOrFail($id);
    $pilihpenanggungjawab = User::where('role', 'guru')->get();
    return view('admin.instansi.instansiedit', compact('instansi', 'pilihpenanggungjawab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'guru_id' => 'required|exists:users,id',
        'bidang' => 'required|string|max:45',  // Tambahkan validasi untuk bidang
    ]);

    // Update data instansi
    $instansi = Instansi::findOrFail($id);
    $instansi->update([
        'name' => $request->name,
        'alamat' => $request->alamat,
        'phone' => $request->phone,
        'email' => $request->email,
        'guru_id' => $request->guru_id,
        'bidang' => $request->bidang,  // Pastikan bidang juga diupdate
    ]);

    return redirect('/instansi');
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

    public function infoInstansi() {
        $instansi = Instansi::all();  // Mengambil semua data instansi
        return view('siswa.info_instansi', compact('instansi'));
    }

}
