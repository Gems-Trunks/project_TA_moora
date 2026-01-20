<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MajelisModel;
use ReturnTypeWillChange;

class MajelisController extends Controller
{

    // Isi nya cuma CRUD Majelis
    public function indexMajelis()
    {
        $data = MajelisModel::get();
        return view("admin.calon_majelis.index", compact('data'));
    }

    public function createMajelis()
    {
        return view('admin.calon_majelis.create');
    }

    public function storeMajelis(Request $request)
    {
        $request->validate([
            'nama_calon' => 'string|required|max:255',
            'jenis_kelamin' => 'string|required|',
            'usia' => 'integer|required|',
            'lama_menjadi_jemaat' => 'integer|required',
        ]);

        MajelisModel::create($request->all());
        return redirect()->route('admin.majelis.index')->with('success', 'Data Jemaat berhasil ditambah');
    }

    public function editMajelis($id)
    {
        $data = MajelisModel::findOrFail($id);
        return view('admin.calon_majelis.edit', compact("data"));
    }

    public function updateMajelis($id, Request $request)
    {
        $request->validate([
            'nama_calon' => 'string|required|max:255',
            'jenis_kelamin' => 'string|required|',
            'usia' => 'integer|required|',
            'lama_menjadi_jemaat' => 'integer|required',
        ]);
        $data = MajelisModel::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.majelis.index')->with('success', 'Data berhasil di ubah/edit');
    }

    public function deleteMajelis($id)
    {
        $data = MajelisModel::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil di hapus');
    }
}
