<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $admin = DB::table('tb_admin')->get();
        return view('admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan tampilan untuk membuat pengguna baru.
        return view('admin.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data.
        $validasi = $request->validate(
            [
                'nama' => 'required|unique:tb_admin|max:45',
                'username' => 'required|max:45',
                'password' => 'required|min:8',
            ],

            [
                'nama.required' => 'Nama wajib diisi',
                'nama.unique' => 'Nama tidak boleh sama',
                'nama.max' => 'Nama tidak boleh lebi dari 45 huruf',
                'username.required' => 'Username wajib diisi',
                'username.max' => 'Username tidak boleh lebi dari 45 huruf',
                'password.required' => 'Password Wajib diisi.',
                'password.min' => 'Password minimal 8 karakter',
            ],
        );

        // Membuat pengguna baru dan menyimpannya di database.
        DB::table('tb_admin')->insert(
            [
                'nama'=>$request->nama,
                'username'=>$request->username,
                'password'=>$request->password,
            ]
        );

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail pengguna berdasarkan ID yang diberikan.
        $admin = DB::table('tb_admin')
                ->where('id_admin', '=', $id)->get();
        return view('admin.show', compact('admin'));
    }

    public function showDataAdmin()
    {
        $dataAdmin = Admin::all();

        return view('admin.index', compact('dataAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form edit pengguna berdasarkan ID yang diberikan.
        $admin = DB::table('tb_admin')
                ->where('id_admin', $id)->get();
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mengupdate data pengguna berdasarkan ID yang diberikan.
        DB::table('tb_admin')->where('id_admin', $id)->update(
            [
                'nama'=>$request->nama,
                'username'=>$request->username,
                'password'=>$request->password,
            ]
        );

        return redirect('/admin'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data pengguna berdasarkan ID yang diberikan.
        DB::table('tb_admin')->where('id_admin', $id)->delete();

         return redirect('/admin');
    }
}
