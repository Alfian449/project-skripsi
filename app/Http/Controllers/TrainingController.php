<?php

namespace App\Http\Controllers;

use App\Exports\PlotingprakerinExport;
use App\Models\Instansi;
use App\Models\Logbook;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function exportPlotingPrakerin()
{
    return Excel::download(new PlotingprakerinExport, 'ploting_prakerin.xlsx');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'user_id' => 'exists:users,id',
                'instansi_id' => 'exists:instansis,id',
                // 'jurusan' => 'required',
            ],
        );

        $user = Auth::user();

        // Menghapus instansi sebelumnya jika ada
        Training::where('user_id', $user->id)->delete();

        // Menyimpan instansi baru
        $validasi['user_id'] = $user->id;
        Training::create($validasi);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        $logbook = Logbook::with(['training', 'training.instansi'])->where('training_id', $training->id)->get();
        // return $training->load(['instansi', 'instansi.guru']);
        return view('siswa.logbook.logbookindex', compact(['logbook', 'training']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //
    }

    public function showPendingRequests()
    {
        $pendingRequests = Training::where('status', 'pending')->get();
        return view('admin.training.trainingindex', compact('pendingRequests'));
    }

//     public function approve($id)
// {
//     $training = Training::findOrFail($id);
//     $training->status = 'approved';
//     $training->save();

//     return redirect()->back()->with('success', 'Data siswa berhasil di-approve.');
// }

public function approve($id)
{
    $training = Training::findOrFail($id);

    // Ambil instansi terkait
    $instansi = Instansi::find($training->instansi_id);

    if ($instansi && $instansi->kuota > 0) {
        // Kurangi kuota instansi
        $instansi->kurangiKuota();

        // Set status training menjadi 'approved'
        $training->status = 'approved';
        $training->save();

        return redirect()->back()->with('success', 'Data siswa berhasil di-approve dan kuota instansi berkurang.');
    }

    return redirect()->back()->with('error', 'Gagal meng-approve data siswa. Kuota instansi sudah habis.');
}


public function reject($id)
{
    $training = Training::findOrFail($id);
    $training->status = 'rejected';
    $training->save();

    return redirect()->back()->with('success', 'Data siswa berhasil di-reject.');
}

public function edit($id)
{
    $training = Training::findOrFail($id);
    return view('admin.training.edit', compact('training'));
}

public function update(Request $request, $id)
{
    $training = Training::findOrFail($id);
    $training->instansi_id = $request->input('instansi_id');
    $training->jurusan = $request->input('jurusan');
    $training->save();

    return redirect()->route('training.index')->with('success', 'Data siswa berhasil di-update.');
}

public function history()
{
    $history = Training::where('user_id', auth()->id())
                        ->where('status', 'approved')
                        ->get();

    return view('siswa.history', compact('history'));
}

public function approvePilihanInstansi($siswaId) {
    $siswa = User::find($siswaId);
    $instansi = Instansi::find($siswa->instansi_id);
    $instansi->kurangiKuota();

    // Lakukan proses approval lainnya
}

}
