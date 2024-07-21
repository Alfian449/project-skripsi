<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $siswa = User::whereRole('siswa')->get();
        return view('admin.siswa.siswaindex', compact('siswa'));
    }

    public function export()
    {
        return Excel::download(new SiswaExport, 'Data Siswa.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new SiswaImport,request()->file('file'));

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan tampilan untuk membuat siswa baru.
        return view('admin.siswa.siswaform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Proses validasi data
    $validasi = $request->validate([
        'nis' => 'required|unique:users|max:10',
        'username' => 'required|unique:users|max:45',
        'name' => 'required|unique:users|max:45',
        'password' => 'required',
        'kelas' => 'required',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'phone' => 'required|numeric',
        'alamat' => 'required|string|max:100',
        'foto' => 'image|mimes:jpg,jpeg,png|max:2048|nullable', // Menambahkan nullable untuk membolehkan kosong
    ]);

    // Proses upload foto
    if (!empty($request->foto)) {
        $fileName = $request->name . '.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/fotos/'), $fileName);
        $validasi['foto'] = $fileName;
    } else {
        $validasi['foto'] = null; // Menetapkan nilai null jika tidak ada foto yang diunggah
    }

    $validasi['password'] = Hash::make($request->password); // Hash password yang diinputkan
    $validasi['role'] = 'siswa';

    User::create($validasi);

    return redirect('/siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan data pengguna berdasarkan ID.
        $siswa = DB::table('users')
                ->where('id', '=', $id)->get();
        return view('admin.siswa.siswashow', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit pengguna berdasarkan ID yang diberikan.
    $siswa = DB::table('users')->where('id', $id)->first();
    if (!$siswa) {
        return redirect('siswa')->withErrors(['Data siswa tidak ditemukan']);
    }
    return view('admin.siswa.siswaedit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input lain
    $request->validate([
        'nis' => 'required',
        'username' => 'required',
        'name' => 'required',
        'password' => 'required',
        'kelas' => 'required',
        'jenis_kelamin' => 'required',
        'phone' => 'required',
        'alamat' => 'required',
    ]);

    $data = [
        'nis' => $request->nis,
        'username' => $request->username,
        'name' => $request->name,
        'password' => $request->password, // Pertimbangkan untuk mengenkripsi password
        'kelas' => $request->kelas,
        'jenis_kelamin' => $request->jenis_kelamin,
        'phone' => $request->phone,
        'alamat' => $request->alamat,
    ];

    if(!empty($request->foto)){
        $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $fileName = $request->name . '.' . $request->foto->extension();
        $request->foto->move(public_path('uploads/fotos/'), $fileName);
        $data['foto'] = $fileName;
    }

    // Update data guru
    DB::table('users')->where('id', $id)->update($data);

    return redirect('siswa' . '/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $siswa)
    {
        // Menghapus data siswa berdasarkan ID.
        $siswa->delete();

         return redirect('/siswa');
    }

}
