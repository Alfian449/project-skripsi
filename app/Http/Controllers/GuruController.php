<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $guru = User::whereRole('guru')->get();
        // dd($guru);
        return view('admin.guru.guruindex', compact('guru'));
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
        // proses validasi data
        $validasi = $request->validate(
            [
                'username' => 'required|unique:users|max:45',
                'name' => 'required|unique:users|max:45',
                'password' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'phone' => 'required|numeric|',
                'alamat' => 'required|string|max:100',
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            ],

            [
                'name.required' => 'Nama wajib diisi',
                'name.unique' => 'Nama tidak boleh sama',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',
                'phone.required' => 'Nomor HP wajib diisi.',
                'phone.numeric' => 'Nomor HP harus berupa angka.',
                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 100 karakter.',
                'foto.image' => 'File gambar harus jpg,jpeg,png',
                'foto.max' => 'Ukuran file gambar maksimal 2048',
            ],
        );

        // proses upload foto
        if(!empty($request->foto)){
            $request->validate([
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images/guru'), $fileName);
        }else{
            $fileName = '';
        }
        $validasi['password'] = Hash::make('password');
        $validasi['role'] = 'guru';
        $validasi['foto'] = $fileName;

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
        $guru = DB::table('users')
                ->where('id', $id)->get();
        return view('admin.guru.guruedit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!empty($request->foto)){
            $request->validate([
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images/guru'), $fileName);
        }else{
            $fileName = '';
        }

        // Update data siswa
        DB::table('users')->where('id', $id)->update(
            [
                'username'=>$request->username,
                'name'=>$request->name,
                'password'=>$request->password,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'phone'=>$request->phone,
                'alamat'=>$request->alamat,
                'foto'=>$fileName,
            ]
        );

        return redirect('guru'.'/'.$id);
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
}
