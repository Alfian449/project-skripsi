<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\DassiswaController;
use App\Http\Controllers\SearchlogbookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
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



// Routing sidebar
Route::resource('/admin', AdminController::class);
Route::resource('/guru', GuruController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/instansi', InstansiController::class);
Route::resource('/logbook', LogbookController::class);
Route::resource('/dasadmin', DasadminController::class);
Route::resource('/dassiswa', DassiswaController::class);


// Routing untuk pencarian
Route::get('/searchsiswa', [SearchsiswaController::class, 'searchsiswa'])->name('searchsiswa');
Route::get('/searchguru', [SearchguruController::class, 'searchguru'])->name('searchguru');
Route::get('/searchinstansi', [SearchinstansiController::class, 'searchinstansi'])->name('searchinstansi');
Route::get('/searchlogbook', [SearchlogbookController::class, 'searchlogbook'])->name('searchlogbook');


// Routing export-import excel
Route::post('/siswasi-import', [SiswaController::class, 'import'])->name('siswasi.import');
Route::get('/siswasi-export', [SiswaController::class, 'export'])->name('siswasi.export');
Route::post('/gurus-import', [GuruController::class, 'import'])->name('gurus.import');
Route::get('/gurus-export', [GuruController::class, 'export'])->name('gurus.export');
Route::post('/instansi-import', [InstansiController::class, 'import'])->name('instansi.import');
Route::get('/instansi-export', [InstansiController::class, 'export'])->name('instansi.export');



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
