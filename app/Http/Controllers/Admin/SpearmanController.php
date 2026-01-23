<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilModel;
use App\Models\MajelisModel;
use App\Models\SpearmanModel;
use Illuminate\Http\Request;

class SpearmanController extends Controller
{
    //
    public function index()
    {
        $data = SpearmanModel::with(['majelis', 'hasilMoora'])
            ->join('hasil_moora', 'hasil_moora.id_calon', '=', 'pengujian_spearman.id_calon')
            ->orderBy('hasil_moora.peringkat', 'asc')
            ->select('pengujian_spearman.*')
            ->get();
        $n = $data->count();
        $sumD2 = $data->sum('d_kuadrat');

        $rho = 0;
        if ($n > 1) {
            $rho = 1 - ((6 * $sumD2) / ($n * ($n ** 2 - 1)));
        }

        return view('admin.spearman.index', compact(
            'data',
            'rho',
            'sumD2',
            'n'
        ));
    }

    public function rankCreate()
    {
        $data = HasilModel::with(['majelis',])
            ->orderBy('peringkat')
            ->get();

        return view('admin.spearman.rank', compact('data'));
    }

    public function rankStore(Request $request)
    {
        $request->validate([
            'ranking' => 'required|array',
            'ranking.*.id_calon' => 'required|exists:calon_majelis,id',
            'ranking.*.skor_manual' => 'required|numeric'
        ]);

        $inputs = collect($request->ranking);

        // Ambil nilai MOORA
        $ids = $inputs->pluck('id_calon');

        $dataMoora = HasilModel::whereIn('id_calon', $ids)
            ->get()
            ->map(fn($item) => [
                'id_calon' => $item->id_calon,
                'skor' => $item->nilai_yi
            ]);

        // Hitung ranking (AVG)
        $rankYi = $this->calculateRankAvg($inputs, 'skor_manual', 'asc'); // Yi
        $rankXi = $this->calculateRankAvg($dataMoora, 'skor');     // Xi

        // Simpan ke tabel spearman
        foreach ($ids as $id) {
            $yi = $rankYi[$id];
            $xi = $rankXi[$id];

            $d = $xi - $yi;

            SpearmanModel::updateOrCreate(
                ['id_calon' => $id],
                [
                    'nilai_manual' => $yi,   // Yi
                    'nilai_sistem' => $xi,   // Xi
                    'd' => $d,
                    'd_kuadrat' => pow($d, 2)
                ]
            );
        }

        return redirect()
            ->route('admin.korelasi.index')
            ->with('success', 'Data Spearman berhasil diperbarui menggunakan metode Rank Average.');
    }


    // Fungsi Privat untuk menghitung peringkat rata-rata 

    private function calculateRankAvg($collection, $valueField, $direction = 'desc')
    {
        $sorted = collect($collection)
            ->sortBy($valueField, SORT_REGULAR, $direction === 'desc')
            ->values();

        $ranks = [];
        $currentRank = 1;

        $grouped = $sorted->groupBy($valueField);

        foreach ($grouped as $items) {
            $count = $items->count();
            $avgRank = ($currentRank + ($currentRank + $count - 1)) / 2;

            foreach ($items as $item) {
                $ranks[$item['id_calon']] = $avgRank;
            }

            $currentRank += $count;
        }

        return $ranks;
    }

    public function reset()
    {
        SpearmanModel::truncate();

        return redirect()
            ->route('admin.korelasi.index')
            ->with('success', 'Data pengujian Spearman berhasil di-reset.');
    }
}
