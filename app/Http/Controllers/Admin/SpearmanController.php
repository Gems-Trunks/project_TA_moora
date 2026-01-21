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
            ->orderBy('nilai_sistem')
            ->get();

        $n = $data->count();
        $sumD2 = $data->sum('d_kuadrat');

        $rho = 0;
        if ($n > 1) {
            $rho = 1 - ((6 * $sumD2) / ($n * ($n * $n - 1)));
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
        $data = HasilModel::with('majelis')
            ->orderBy('peringkat')
            ->get();

        return view('admin.spearman.rank', compact('data'));
    }

    public function rankStore(Request $request)
    {
        $request->validate([
            'ranking' => 'required|array',
            'ranking.*.id_calon' => 'required|exists:calon_majelis,id',
            'ranking.*.peringkat' => 'required|integer|min:1'
        ]);

        foreach ($request->ranking as $item) {
            $hasilMoora = HasilModel::where('id_calon', $item['id_calon'])->first();

            if (!$hasilMoora) continue;

            $rankManual = $item['peringkat'];
            $rankMoora = $hasilMoora->peringkat;

            $d = $rankMoora - $rankManual;


            SpearmanModel::updateOrCreate(
                ['id_calon' => $item['id_calon']],
                [
                    'nilai_manual' => $rankManual,
                    'nilai_sistem' => $rankMoora,
                    'd' => $d,
                    'd_kuadrat' => $d * $d
                ]
            );
        }

        return redirect()
            ->route('admin.korelasi.index')
            ->with('success', 'Ranking manual berhasil disimpan');
    }
}
