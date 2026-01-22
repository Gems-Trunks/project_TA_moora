<?php

namespace App\Http\Controllers\Jemaat;

use App\Http\Controllers\Controller;
use App\Models\HasilModel;
use App\Models\KriteriaModel;
use App\Models\MajelisModel;
use Illuminate\Http\Request;
use App\Models\PenilaianModel;

class PerhitunganController extends Controller
{
    // perhitungan ini berisi logika penilaian dimana merubah data data yang ada di view dari huruf menjadi angka menyesuaikan ketentuan yang ada

    public function penilaian()
    {
        $calonMajelis = MajelisModel::all();
        $kriteria = KriteriaModel::all();

        return view('jemaat.penilaian', compact('calonMajelis', 'kriteria'));
    }

    public function penilaianStore(Request $request)
    {
        $request->validate([
            'id_calon' => 'required|exists:calon_majelis,id',
            'nilai' => 'required|array',
        ]);

        $idJemaat = auth()->user()->id; // atau id_jemaat
        $calonId = $request->id_calon;
        $calon = MajelisModel::findOrFail($calonId);

        foreach ($request->nilai as $idKriteria => $skor) {
            PenilaianModel::updateOrCreate(
                [
                    'id_jemaat' => $idJemaat,
                    'id_calon' => $calonId,
                    'id_kriteria' => $idKriteria
                ],
                ['nilai' => $skor]
            );
        }

        // nilai otomatis
        PenilaianModel::updateOrCreate(
            [
                'id_jemaat' => $idJemaat,
                'id_calon' => $calonId,
                'id_kriteria' => 7
            ],
            ['nilai' => $calon->usia]
        );

        PenilaianModel::updateOrCreate(
            [
                'id_jemaat' => $idJemaat,
                'id_calon' => $calonId,
                'id_kriteria' => 8
            ],
            ['nilai' => $calon->lama_menjadi_jemaat]
        );

        return redirect()->route('jemaat.dashboard')
            ->with('success', 'Penilaian berhasil disimpan');
    }

    public function indexPerengkingan()
    {
        $data = HasilModel::with('majelis')
            ->orderBy('peringkat')
            ->get();
        return view("jemaat.perengkingan.index", compact('data'));
    }

    public function storePerengkingan(Request $request)
    {
        $request->validate(['keterangan' => 'max:100']);

        HasilModel::create([
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'keterangan berhasil di simpan');
    }

    public function cetak()
    {
        $data = HasilModel::with('majelis')
            ->orderBy('peringkat', 'asc')
            ->get();

        return view('jemaat.perengkingan.cetak', [
            'data' => $data,
            'tanggal' => now(),
        ]);
    }
}
