<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        // Proses validsi data
        $validasi = $request->validate(
            [
                'nis' => 'required|unique:users|max:10',
                'username' => 'required|unique:users|max:20',
                'name' => 'required|unique:users|max:45',
                'password' => 'required|min:8',
                'kelas' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'phone' => 'required|min:12',
                'alamat' => 'required|max:100',
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            ],
        );

        // Proses upload foto
        if(!empty($request->foto)){
            $request->validate([
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->name.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $fileName);
        }else{
            $fileName = '';
        }

        $validasi['password'] = Hash::make('password');
        $validasi['role'] = 'siswa';
        $validasi['foto'] = $fileName;

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
        // Menampilkan form edit data pengguna berdasarkan ID.
        $siswa = DB::table('users')
                ->where('id', $id)->get();
        return view('admin.siswa.siswaedit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // proses upload foto
        if(!empty($request->foto)){
            $request->validate([
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $fileName);
        }else{
            $fileName = '';
        }

        // Update data siswa
        DB::table('users')->where('id', $id)->update(
            [
                'nis'=>$request->nis,
                'username'=>$request->username,
                'name'=>$request->name,
                'password'=>$request->password,
                'kelas'=>$request->kelas,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'phone'=>$request->phone,
                'alamat'=>$request->alamat,
                'foto'=>$fileName,
            ]
        );

        return redirect('siswa'.'/'.$id);
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
