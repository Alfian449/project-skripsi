<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdmintrainingController;
use App\Http\Controllers\DasadminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\SearchguruController;
use App\Http\Controllers\SearchinstansiController;
use App\Http\Controllers\SearchsiswaController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DasguruController;
use App\Http\Controllers\DassiswaController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PilihinstansiController;
use App\Http\Controllers\RekapnilaiController;
use App\Http\Controllers\SearchplotingController;
use App\Http\Controllers\TrainingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great! aneh
|
*/

// Routing halaman dashboard
Route::middleware('auth')->group(function () {
    Route::get('/halamanadmin', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/halamansiswa', function () {
        return view('dashboard.indexsiswa');
    })->name('dashboard');

    Route::get('/halamanguru', function () {
        return view('dashboard.indexguru');
    })->name('dashboard');
});



// Routing halaman admin
Route::middleware('auth')->group(function () {
Route::resource('/admin', AdminController::class);
Route::resource('/guru', GuruController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/instansi', InstansiController::class);
Route::resource('/jurusan', JurusanController::class);
Route::resource('/list-training', AdmintrainingController::class);
});


// Routing halaman siswa
Route::resource('/logbook', LogbookController::class);
Route::resource('/pilihinstansi', PilihinstansiController::class);
Route::resource('/history', HistoryController::class);
Route::resource('/trainings', TrainingController::class);
Route::get('/logbook/{training}/create', [LogbookController::class, 'createFormLogbook'])->name('logbook.createFormLogbook');



// Routing halaman guru
Route::middleware('auth')->group(function () {
Route::resource('/monitoring', MonitoringController::class);
Route::resource('/rekapnilai', RekapnilaiController::class);
});


// Routing untuk dashboard
Route::resource('/dasadmin', DasadminController::class);
Route::resource('/dassiswa', DassiswaController::class);
Route::resource('/dasguru', DasguruController::class);


// Routing untuk pencarian
Route::middleware('auth')->group(function () {
Route::get('/searchsiswa', [SearchsiswaController::class, 'searchsiswa'])->name('searchsiswa');
Route::get('/searchguru', [SearchguruController::class, 'searchguru'])->name('searchguru');
Route::get('/searchinstansi', [SearchinstansiController::class, 'searchinstansi'])->name('searchinstansi');
Route::get('/searchploting', [SearchplotingController::class, 'searchploting'])->name('searchploting');
});


// Routing export-import excel
Route::post('/siswasi-import', [SiswaController::class, 'import'])->name('siswasi.import');
Route::get('/siswasi-export', [SiswaController::class, 'export'])->name('siswasi.export');
Route::post('/gurus-import', [GuruController::class, 'import'])->name('gurus.import');
Route::get('/gurus-export', [GuruController::class, 'export'])->name('gurus.export');
Route::post('/instansi-import', [InstansiController::class, 'import'])->name('instansi.import');
Route::get('/instansi-export', [InstansiController::class, 'export'])->name('instansi.export');
Route::get('/rekapnilai-export', [RekapnilaiController::class, 'export'])->name('rekapnilai.export');


// Routing login
Route::group(['middleware' => ['guest']], function() {
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');;
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


// logout
Route::post('/logout', function() {
    auth()->logout();
    session()->flush();
    return redirect()->route('login')->with('success', 'Logout success');
})->middleware('auth')->name('logout');


// Routing export PDF Rekap Nilai
Route::get('pdf', [RekapnilaiController::class, 'generatePDF']);


Route::get('instansi/{id}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
Route::put('instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');

Route::get('/dasguru', [DasguruController::class, 'dashboardGuru'])->name('halamanguru');
Route::get('/dassiswa', [DassiswaController::class, 'dashboardSiswa'])->name('halamansiswa');

Route::get('/halamanguru', [GuruController::class, 'dashboardGuru'])->name('halamanguru');
Route::get('/halamansiswa', [SiswaController::class, 'dashboardSiswa'])->name('halamansiswa');

Route::post('/siswas/massDelete', [SiswaController::class, 'massDelete'])->name('siswas.massDelete');

Route::post('/logbook/approve/{id}', [LogbookController::class, 'approve'])->name('logbook.approve');

Route::post('/training/approve/{id}', [TrainingController::class, 'approve'])->name('training.approve');
Route::post('/training/reject/{id}', [TrainingController::class, 'reject'])->name('training.reject');
Route::get('/training/edit/{id}', [TrainingController::class, 'edit'])->name('training.edit');
Route::post('/training/update/{id}', [TrainingController::class, 'update'])->name('training.update');

Route::get('/siswa/history', [SiswaController::class, 'history'])->name('siswa.history');

