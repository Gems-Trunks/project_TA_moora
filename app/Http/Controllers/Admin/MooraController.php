<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\ProsesMooraModel;
use App\Services\Moora\MooraService;
use App\Models\HasilModel;

class MooraController extends Controller
{
    // pakai service yang menangani proses moora
    // letak nya di App/Services/Moora/MooraService.php
    // sisa nya isi nya cuma Route ke index/dashboard
    protected $mooraService;
    public function __construct(MooraService $mooraService)
    {
        $this->mooraService = $mooraService;
    }

    public function prosesMoora()
    {
        $this->mooraService->proses();

        return redirect()->back()
            ->with('success', 'Perhitungan MOORA berhasil dilakukan');
    }

    public function indexMoora()
    {
        $penilaian = PenilaianModel::with('majelis')->get()->groupBy('id_calon');
        $kriteria = KriteriaModel::all();

        // Mengambil data yang sudah pernah disimpan di tabel proses_moora
        $dataProses = ProsesMooraModel::with(['majelis', 'kriteria'])->get();


        $hasilRanking = HasilModel::with('majelis')
            ->orderBy('peringkat')
            ->get();

        $adaHasil = $hasilRanking->count() > 0;

        return view('admin.proses_moora.index', compact('penilaian', 'kriteria', 'dataProses', 'hasilRanking', 'adaHasil'));
    }
}
