<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\MajelisController;
use App\Http\Controllers\Admin\MooraController;
use App\Http\Controllers\Admin\SpearmanController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\JemaatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Jemaat\JemaatController;
use App\Http\Controllers\Jemaat\PerhitunganController;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Mod;

Route::get('/', function () {
    if (Auth::check()) {
        // Jika sudah login, arahkan sesuai role
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('jemaat.dashboard');
    }
    // Jika belum login, baru ke halaman login
    return redirect()->route('login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_proses'])->name('login_proses');
});

Route::middleware(['auth'])->group(function () {

    //Route Admin
    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('/', 'index')->name('dashboard');
                // Route Profil admin
                Route::get('/profil', 'profil')->name('profil');
                Route::patch('/profil/update', 'profilUpdate')->name('profil.update');
            });
            // Route Calon Majelis
            Route::controller(MajelisController::class)->prefix('majelis')->name('majelis.')->group(function () {
                Route::get('/', 'indexMajelis')->name('index');
                Route::get('/tambah', 'createMajelis')->name('create');
                Route::post('/simpan', 'storeMajelis')->name('store');
                Route::get('/edit/{id}', 'editMajelis')->name('edit');
                Route::put('/update/{id}', 'updateMajelis')->name('update');
                Route::delete('/hapus/{id}', 'deleteMajelis')->name('delete');
            });
            // Route Kriteria & Bobot
            Route::controller(KriteriaController::class)->prefix('kriteria')->name('kriteria.')->group(function () {
                Route::get('/', 'indexKriteria')->name('index');
                Route::get('/tambah', 'createKriteria')->name('create');
                Route::post('/simpan', 'storeKriteria')->name('store');
                Route::get('/edit/{id}', 'editKriteria')->name('edit');
                Route::put('/update/{id}', 'updateKriteria')->name('update');
                Route::delete('/hapus/{id}', 'deleteKriteria')->name('delete');
            });
            // Route Perhitungan Moora
            Route::controller(MooraController::class)->prefix('Hasil-Moora')->name('moora.')->group(function () {
                Route::get('/', 'indexMoora')->name('index');
                Route::get('/perhitungan-moora', 'show')->name('show');
                Route::post('/proses', 'prosesMoora')->name('proses');
                Route::delete('/reset', [MooraController::class, 'resetMoora'])->name('reset');
            });
            // Route User
            Route::controller(UserController::class)->prefix('akun')->name('user.')->group(function () {
                Route::get('/', "index")->name('index');
                Route::get('/tambah', 'create')->name('create');
                Route::post('/simpan', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/hapus/{id}', 'delete')->name('delete');
            });
            Route::controller(SpearmanController::class)->prefix('spearman')->name('korelasi.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/rank/tambah', 'rankCreate')->name('rank.create');
                Route::post('/rank/store', 'rankStore')->name('rank.store');
            });
        });
    });
    // Route Jemaat
    Route::middleware('role:jemaat')->group(function () {
        Route::controller(JemaatController::class)->prefix('jemaat')->name('jemaat.')->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/penilaian', 'penilaian')->name('penilaian');
        });
        Route::controller(PerhitunganController::class)->prefix('jemaat')->name('jemaat.')->group(function () {
            Route::get('/penilaian', 'penilaian')->name('penilaian');
            Route::post('/penilaian/simpan', 'penilaianStore')->name('penilaian.store');
            Route::get('/perengkingan', 'indexPerengkingan')->name('perengkingan');
            route::post('/perengkingan/store', 'storePerengkingan')->name('perengkingan.store');
            route::get('/perengkingan/cetak', 'cetak')->name('perengkingan.cetak');
        });
    });
    Route::controller(JemaatController::class)->prefix('jemaat')->name('jemaat.')->group(function () {
        Route::get('/profil', 'profil')->name('profil');
        Route::patch('/profil/update/', 'profilUpdate')->name('profil.update');
    });


    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});
