<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Imports\GuruImport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $guru = User::whereRole('guru')->get();
        return view('admin.guru.guruindex', compact('guru'));
    }

    public function export()
    {
        return Excel::download(new GuruExport, 'Data Guru.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new GuruImport,request()->file('file'));

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan tampilan untuk membuat data guru baru.
        return view('admin.guru.guruform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Proses validasi data
    $validasi = $request->validate([
        'nip' => 'required|unique:users|max:45',
        'username' => 'required|unique:users|max:45',
        'name' => 'required|unique:users|max:45',
        'password' => 'required',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'phone' => 'required|numeric',
        'alamat' => 'required|string|max:100',
        'foto' => 'image|mimes:jpg,jpeg,png|max:2048|nullable', // Menambahkan nullable untuk membolehkan kosong
    ]);

    // Proses upload foto
    if (!empty($request->foto)) {
        $fileName = $request->name . '.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/gurus/'), $fileName);
        $validasi['foto'] = $fileName;
    } else {
        $validasi['foto'] = null; // Menetapkan nilai null jika tidak ada foto yang diunggah
    }

    $validasi['password'] = Hash::make($request->password); // Hash password yang diinputkan
    $validasi['role'] = 'guru';

    User::create($validasi);

    return redirect('/guru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail pengguna berdasarkan ID yang diberikan.
        $guru = DB::table('users')
                ->where('id', '=', $id)->get();
        return view('admin.guru.gurushow', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit pengguna berdasarkan ID yang diberikan.
    $guru = DB::table('users')->where('id', $id)->first();
    if (!$guru) {
        return redirect('guru')->withErrors(['Data guru tidak ditemukan']);
    }
    return view('admin.guru.guruedit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input lain
    $request->validate([
        'nip' => 'required',
        'username' => 'required',
        'name' => 'required',
        'password' => 'required',
        'jenis_kelamin' => 'required',
        'phone' => 'required',
        'alamat' => 'required',
    ]);

    $data = [
        'nip' => $request->nip,
        'username' => $request->username,
        'name' => $request->name,
        'password' => $request->password, // Pertimbangkan untuk mengenkripsi password
        'jenis_kelamin' => $request->jenis_kelamin,
        'phone' => $request->phone,
        'alamat' => $request->alamat,
    ];

    if(!empty($request->foto)){
        $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $fileName = $request->name . '.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/gurus/'), $fileName);
        $data['foto'] = $fileName;
    }

    // Update data guru
    DB::table('users')->where('id', $id)->update($data);

    return redirect('guru' . '/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $guru)
    {
        // Menghapus data siswa berdasarkan ID.
        $guru->delete();

         return redirect('/guru');
    }

    public function dashboardGuru()
    {
    // Mendapatkan data guru yang sedang login
    $guru = auth()->user();

    // Mengirim data ke view
    return view('dashboard.indexguru', compact('guru'));
    }

}
