<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Isi nya routes dan edit profil
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profil(Request $request)
    {
        $user = $request->user();
        return view('admin.profil', compact('user'));
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

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
}
