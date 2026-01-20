<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Logika Login
    public function login()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $data = [
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        $credentials = $request->only('username', 'password');
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['username' => 'Username tidak ditemukan']);
        }

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors(['password' => 'Password salah']);
        }

        if (Auth::attempt($data)) {
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Logika pengalihan berdasarkan Role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang Admin');
            } elseif ($user->role == 'jemaat') {
                return redirect()->route('jemaat.dashboard')->with('success', 'Selamat Datang Jemaat');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Username atau Password Salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil keluar aplikasi');
    }
}
