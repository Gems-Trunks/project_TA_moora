<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilModel;
use App\Models\KriteriaModel;
use App\Models\MajelisModel;
use App\Models\SpearmanModel;

class LaporanController extends Controller
{
    //
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'jenis_laporan' => 'required'
        ]);

        switch ($request->jenis_laporan) {

            case 'calon':
                return $this->cetakMajelis();

            case 'kriteria':
                return $this->cetakKriteria();

            case 'ranking':
                return $this->cetakRanking();

            case 'spearman':
                return $this->cetakSpearman();

            default:
                return back()->with('error', 'Jenis laporan tidak valid');
        }
    }

    private function cetakRanking()
    {
        $data = HasilModel::with('majelis')
            ->orderBy('peringkat')
            ->get();

        return view('admin.laporan.cetak_rangking', compact('data'), ['tanggal' => now()]);
    }

    private function cetakSpearman()
    {
        $data = SpearmanModel::with('majelis')
            ->orderBy('nilai_sistem')
            ->get();

        $n = $data->count();
        $sumD2 = $data->sum('d_kuadrat');

        $rho = 0;
        if ($n > 1) {
            $rho = 1 - ((6 * $sumD2) / ($n * ($n * $n - 1)));
        }

        return view('admin.laporan.cetak_spearman', [
            'data' => $data,
            'n' => $n,
            'sumD2' => $sumD2,
            'rho' => $rho,
            'tanggal' => now(),
        ]);
    }

    private function cetakMajelis()
    {
        $data = MajelisModel::orderBy('nama_calon')->get();

        return view('admin.laporan.cetak_majelis', [
            'data' => $data,
            'tanggal' => now()
        ]);
    }

    private function cetakKriteria()
    {
        $data = KriteriaModel::orderBy('nama_kriteria')->get();

        return view('admin.laporan.cetak_kriteria', [
            'data' => $data,
            'tanggal' => now()
        ]);
    }
}
