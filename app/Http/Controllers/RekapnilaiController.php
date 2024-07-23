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
        // Mengambil semua data pengguna dari database dan menampilkannya di tampilan.
        $rekapnilai = Rekapnilai::with(['response', 'user'])->get();
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
        $users = User::with(['trainings', 'trainings.instansi', 'trainings.instansi.guru'])->whereRole('siswa')
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
                'kedisiplinan' => 'required',
                'tanggung_jawab' => 'required',
                'komunikasi' => 'required',
                'kerja_sama' => 'required',
                'inisiatif' => 'required',
                'ketekunan' => 'required',
                'kreativitas' => 'required',
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
    public function edit(string $id)
    {
        $rekapnilai = DB::table('rekaps')
        ->where('id', $id)->get();
        return view('guru.rekapnilai.rekapnilaiedit', compact('rekapnilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update data siswa
        DB::table('rekaps')->where('id', $id)->update(
            [
                'name'=>$request->name,
                'kedisiplinan'=>$request->kedisiplinan,
                'tanggung_jawab'=>$request->tanggung_jawab,
                'komunikasi'=>$request->komunikasi,
                'kerja_sama'=>$request->kerja_sama,
                'inisiatif'=>$request->inisiatif,
                'ketekunan'=>$request->ketekunan,
                'kreativitas'=>$request->kreativitas,
            ]
        );

        return redirect('rekapnilai'.'/'.$id);
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
