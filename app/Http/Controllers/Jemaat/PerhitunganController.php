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
        $calonId = $request->id_calon;
        $calon = MajelisModel::findOrFail($calonId);

        foreach ($request->nilai as $kriteria_id => $skor) {
            PenilaianModel::updateOrCreate(
                ['id_calon' => $calonId, 'id_kriteria' => $kriteria_id],
                ['nilai' => $skor]
            );
        }

        PenilaianModel::updateOrCreate(
            ['id_calon' => $calonId, 'id_kriteria' => 7],
            ['nilai' => $calon->usia]
        );

        PenilaianModel::updateOrCreate(
            ['id_calon' => $calonId, 'id_kriteria' => 7],
            ['nilai' => $calon->usia]
        );


        $lama = $calon->lama_menjadi_jemaat;
        $bobotC5 = 1;

        if ($lama > 15) {
            $bobotC5 = 4; // Sangat Lama 
        } elseif ($lama >= 11 && $lama <= 15) {
            $bobotC5 = 3; // Lama 
        } elseif ($lama >= 6 && $lama <= 10) {
            $bobotC5 = 2; // Cukup Lama 
        } else {
            $bobotC5 = 1; // Baru (<= 5 tahun) 
        }

        PenilaianModel::updateOrCreate(
            ['id_calon' => $calonId, 'id_kriteria' => 8],
            ['nilai' => $bobotC5]
        );
        return redirect()->route('jemaat.dashboard')->with('success', 'Penilaian Berhasil Disimpan!');
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
