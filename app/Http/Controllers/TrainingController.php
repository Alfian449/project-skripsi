<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function approve($id)
{
    $training = Training::findOrFail($id);
    $training->status = 'approved';
    $training->save();

    return redirect()->back()->with('success', 'Data siswa berhasil di-approve.');
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

}
