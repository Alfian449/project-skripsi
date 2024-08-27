<?php

namespace App\Http\Controllers;

use App\Exports\RekapnilaiExport;
use App\Models\Rekapnilai;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RekapnilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Memuat data rekap nilai dengan data relasi yang diperlukan
    $rekapnilai = Rekapnilai::with(['user.trainings.instansi'])->get();
    return view('guru.rekapnilai.rekapnilaiindex', compact('rekapnilai'));
}


    public function export()
    {
        return Excel::download(new RekapnilaiExport, 'rekapnilai.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $guruId = auth()->id();
    $users = User::with(['trainings', 'trainings.instansi', 'trainings.instansi.guru'])
        ->whereRole('siswa')
        ->whereHas('trainings.instansi', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })->get();
    return view('guru.rekapnilai.rekapnilaiform', compact('users'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat validasi untuk inputan data pengguna.
        $validasi = $request->validate(
            [
                'user_id' => 'exists:users,id',
                'response_id' => 'exists:users,id',
                'kedisiplinan' => 'required|numeric',
                'tanggung_jawab' => 'required|numeric',
                'komunikasi' => 'required|numeric',
                'kerja_sama' => 'required|numeric',
                'inisiatif' => 'required|numeric',
                'ketekunan' => 'required|numeric',
                'kreativitas' => 'required|numeric',
            ],
        );
        $validasi['user_id'] = $request->user_id;
        $validasi['response_id'] = auth()->id();
        Rekapnilai::create($validasi);

        return redirect('/rekapnilai');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $rekapnilai = RekapNilai::find($id);
    $users = User::where('role', 'siswa')->get(); // ambil data siswa

    return view('guru.rekapnilai.rekapnilaiedit', compact('rekapnilai', 'users'));
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $rekapnilai = Rekapnilai::findOrFail($id);
    $rekapnilai->update([
        'kedisiplinan' => $request->kedisiplinan,
        'tanggung_jawab' => $request->tanggung_jawab,
        'komunikasi' => $request->komunikasi,
        'kerja_sama' => $request->kerja_sama,
        'inisiatif' => $request->inisiatif,
        'ketekunan' => $request->ketekunan,
        'kreativitas' => $request->kreativitas,
    ]);

    return redirect()->route('rekapnilai.index')->with('success', 'Data berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data siswa berdasarkan ID.
        DB::table('rekaps')->where('id', $id)->delete();

         return redirect('/rekapnilai');
    }

    public function generatePDF()
    {
        $rekapnilai = Rekapnilai::get();
        $data = [
            'title' => 'Rekap Nilai Siswa',
            'date' => date('m/d/Y'),
            'rekapnilai' => $rekapnilai
        ];

        $pdf = FacadePdf::loadView('guru.rekapnilai.myPDF', $data);
        return $pdf->download('Data Rekap Nilai.pdf');
    }
}
