<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // isi nya cuma CRUD untuk kriteria
    public function indexKriteria()
    {
        $data = KriteriaModel::all();
        return view('admin.kriteria_bobot.index', compact('data'));
    }

    public function createKriteria()
    {
        return view('admin.kriteria_bobot.create');
    }

    public function storeKriteria(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:100',
            'bobot' => 'required',
            'jenis' => 'required'
        ]);

        KriteriaModel::create($request->all());
        return redirect()->route('admin.kriteria.index')->with('success', 'Data berhasil di simpan');
    }

    public function editKriteria($id)
    {
        $data = KriteriaModel::findOrFail($id);
        return view('admin.kriteria_bobot.edit', compact('data'));
    }

    public function updateKriteria($id, Request $request)
    {
        $data = KriteriaModel::findOrFail($id);
        $request->validate([
            'nama_kriteria' => 'required|string|max:100',
            'bobot' => 'required',
            "jenis" => 'required'
        ]);
        $data->update($request->all());
        return redirect()->route('admin.kriteria.index')->with('success', 'Data berhasil di ubah');
    }

    public function deleteKriteria($id)
    {
        $data = KriteriaModel::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Data berhasil di Hapus');
    }
}
