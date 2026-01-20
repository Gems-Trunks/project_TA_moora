<?php

namespace App\Http\Controllers\Jemaat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JemaatController extends Controller
{
    // isi nya cuman routes ke index dan profil untuk update
    public function index()
    {
        return view('jemaat.dashboard');
    }

    public function profil(Request $request)
    {
        return view('jemaat.profil', ['user' => $request->user()]);
    }

    public function profilUpdate(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('jemaat.dashboard')->with('success', 'Data berhasil diperbarui');
    }
}
