<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MajelisController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\JemaatController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
            });
            Route::controller(MajelisController::class)->prefix('majelis')->name('majelis.')->group(function () {
                Route::get('/', 'indexMajelis')->name('index');
                Route::get('/tambah', 'createMajelis')->name('create');
                Route::post('/simpan', 'storeMajelis')->name('store');
                Route::get('/edit/{id}', 'editMajelis')->name('edit');
                Route::put('/update/{id}', 'updateMajelis')->name('update');
                Route::delete('/update/{id}', 'deleteMajelis')->name('delete');
            });
        });
    });
    // Route Jemaat
    // Route::middleware('role:jemaat')->group(function () {
    //     Route::controller(JemaatController::class)->group(function () {
    //         Route::get('/jemaat/dashboard', 'index')->name('jemaat.dashboard');
    //     });
    // });

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});
