<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
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

    // public function export()
    // {
    //     return Excel::download(new GuruExport, 'dataguru.xlsx');
    // }

    // public function import()
    // {
    //     Excel::import(new GuruImport,request()->file('file'));

    //     return back();
    // }

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
       // Temukan objek Guru dengan ID yang diberikan atau gagal jika tidak ditemukan
    $guru = User::findOrFail($id);

    // Debugging: Cek tipe data dari $guru
    // dd($guru); // Uncomment untuk debugging

    // Validasi request
    $request->validate([
        'name' => 'required',
        'jenis_kelamin' => 'required',
        'phone' => 'required',
        'alamat' => 'required',
        'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Jika ada file foto yang diupload
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($guru->foto && file_exists(public_path('images/guru'.$guru->foto))) {
            unlink(public_path('images/guru'.$guru->foto));
        }

        // Simpan foto baru
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/guru'), $filename);

        // Update path foto di database
        $guru->foto = $filename;
    }

    // Update data guru
    $guru->name = $request->name;
    $guru->jenis_kelamin = $request->jenis_kelamin;
    $guru->phone = $request->phone;
    $guru->alamat = $request->alamat;
    $guru->save();

    return redirect('guru'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data guru berdasarkan ID yang diberikan.
        DB::table('users')->where('id', $id)->delete();

         return redirect('/guru');
    }
}
