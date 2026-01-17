<?php

namespace App\Http\Controllers\Jemaat;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use App\Models\MajelisModel;
use Illuminate\Http\Request;
use App\Models\PenilaianModel;

class PerhitunganController extends Controller
{
    //
    public function penilaian()
    {
        $calonMajelis = MajelisModel::all();
        $kriteria = KriteriaModel::all();

        return view('jemaat.penilaian', compact('calonMajelis', 'kriteria'));
    }

    public function penilaianStore(Request $request)
    {
        // Ambil ID dari body request karena form Anda mengirimkan 'calon_id'
        $calonId = $request->id_calon;
        $calon = MajelisModel::findOrFail($calonId);

        // 1. Simpan Nilai C1, C2, C3 dari Form Jemaat [cite: 4, 9, 14]
        foreach ($request->nilai as $kriteria_id => $skor) {
            PenilaianModel::updateOrCreate(
                ['id_calon' => $calonId, 'id_kriteria' => $kriteria_id],
                ['nilai' => $skor]
            );
        }

        // 2. Simpan Otomatis C4: Usia (Angka Asli) [cite: 16, 18]
        PenilaianModel::updateOrCreate(
            ['id_calon' => $calonId, 'id_kriteria' => 7],
            ['nilai' => $calon->usia] // Mengambil data usia asli calon [cite: 18]
        );

        // 2. Simpan Otomatis C4: Usia (Gunakan ID 7) 
        // Sesuai dokumen: menggunakan angka asli usia [cite: 18]
        PenilaianModel::updateOrCreate(
            ['id_calon' => $calonId, 'id_kriteria' => 7],
            ['nilai' => $calon->usia]
        );

        // 3. Simpan Otomatis C5: Lama Menjadi Jemaat (Gunakan ID 8) 
        // Logika konversi berdasarkan Tabel 3.5:
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
}