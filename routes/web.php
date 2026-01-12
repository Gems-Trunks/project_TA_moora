<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JemaatController;
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
  

    Route::middleware('role:admin')->group(function () {
        Route::controller(AdminController::class)->group( function() {
            Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        });
    });
    Route::middleware('role:jemaat')->group(function () {
        Route::controller(JemaatController::class)->group(function () {
            Route::get('/jemaat/dashboard', 'index')->name('jemaat.dashboard');
        });
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
