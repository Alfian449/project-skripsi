<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Instansi;
use App\Models\User;

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
    ]);

    // Update data instansi
    $instansi = Instansi::findOrFail($id);
    $instansi->update([
        'name' => $request->name,
        'alamat' => $request->alamat,
        'phone' => $request->phone,
        'email' => $request->email,
        'guru_id' => $request->guru_id,
    ]);


        return redirect('instansi'.'/'.$id);
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
