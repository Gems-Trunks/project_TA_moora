<?php

namespace App\Services\Moora;

use App\Models\HasilModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\ProsesMooraModel;

class MooraService
{
   /* Penjelasan Kode
   - $nilaiAwal di ambil di tabel peniliain 
   - $pembagi di ambil dari tabel kriteria
   - $row sendiri itu sesuai dengan berapa banyak kriteria yang ada
   - $nilai bobot di ambil dari nilai bobot yang ada di tabel kriteria 
   - total benefit dan cost di hitung dari bobot aja 
   - nilai yang di simpan itu ke dua tabel ke proses_moora sama hasil_moora 
   */

   public function proses()
   {
      // hapus data lama
      ProsesMooraModel::truncate();
      HasilModel::truncate();

      $penilaian = PenilaianModel::selectRaw(
         'id_calon, id_kriteria, AVG(nilai) as nilai'
      )
         ->groupBy('id_calon', 'id_kriteria')
         ->get()
         ->groupBy('id_calon');

      $kriteria = KriteriaModel::all();

      // cek bobot
      // dd([
      //    'bobot' => $kriteria->pluck('bobot'),
      //    'total_bobot' => $kriteria->sum('bobot')
      // ]);

      // 1. Hitung pembagi
      $pembagi = $this->hitungPembagi($penilaian, $kriteria);

      $hasilYi = [];

      foreach ($penilaian as $id_calon => $items) {
         $totalBenefit = 0;
         $totalCost = 0;

         // cek data 1 calon
         // if ($id_calon == 7) { // ganti 1 dengan id calon yang mau kamu cek
         //    dd([
         //       'id_calon' => $id_calon,
         //       'nilai_awal' => $items->pluck('nilai'),
         //       'normalisasi' => $kriteria->map(function ($k) use ($items, $pembagi) {
         //          $row = $items->where('id_kriteria', $k->id)->first();
         //          $nilai = $row ? $row->nilai : 0;
         //          return $nilai / ($pembagi[$k->id] ?? 1);
         //       }),
         //       'nilai_bobot' => $kriteria->map(function ($k) use ($items, $pembagi) {
         //          $row = $items->where('id_kriteria', $k->id)->first();
         //          $nilai = $row ? $row->nilai : 0;
         //          return ($nilai / ($pembagi[$k->id] ?? 1)) * $k->bobot;
         //       }),
         //    ]);
         // }

         $totalBobot = $kriteria->sum('bobot');

         foreach ($kriteria as $k) {

            $row = $items->where('id_kriteria', $k->id)->first();

            $nilaiAwal   = $row ? $row->nilai : 0;
            $normalisasi = $nilaiAwal / ($pembagi[$k->id] ?? 1);
            $bobotNormal = $k->bobot / $totalBobot;

            $nilaiBobot = $normalisasi * $bobotNormal;

            if (strtolower(trim($k->jenis)) === 'cost') {
               $totalCost += $nilaiBobot;
            } else {
               $totalBenefit += $nilaiBobot;
            }

            ProsesMooraModel::updateOrCreate(
               [
                  'id_calon' => $id_calon,
                  'id_kriteria' => $k->id
               ],
               [
                  'nilai_awal' => $nilaiAwal,
                  'nilai_normalisasi' => $normalisasi,
                  'nilai_bobot' => $nilaiBobot,
                  'nilai_yi' => null
               ]
            );
         }

         // ✅ Yi dihitung SATU KALI
         $yi = $totalBenefit - $totalCost;
         $hasilYi[$id_calon] = $yi;

         // update Yi ke semua baris calon
         ProsesMooraModel::where('id_calon', $id_calon)
            ->update(['nilai_yi' => $yi]);
      }



      // simpan hasil akhir
      $this->simpanHasilAkhir($hasilYi);
   }


   /* -----------hitung pembagi----------
   hitung pembagi akan di lakukan secara satu persatu sesuai sama hasil dari penilaian dimana dia akan mengambil dari data calon_majelis

   - array $pembagi untuk menyimpan kuadrat untuk setiap kriteria

   loop
   - loop akan mengulang list kriteria
   - kemudian ada loop yang akan mengecek lagi tabel penilaian per calon
   - 
   - Sistem mencari nilai yang diberikan kepada setiap calon untuk kriteria tersebut.pow($nilai, 2) artinya nilai tersebut dipangkatkan dua ($x^2$).Hasilnya ditambahkan ke dalam $sumSq.
   -kemudian akan di liat bagaimana nilai di kuadratkan dan di cek apakah nilai bernilai nol apa tidak
   -kemudian hasil di simpan di array $pembagi perkriteria
   
   */
   private function hitungPembagi($penilaian, $kriteria)
   {
      // $pembagi = [];

      // foreach ($kriteria as $k) {

      //    $sumSq = 0;

      //    foreach ($penilaian as $items) {
      //       $nilai = $items->where('id_kriteria', $k->id)->first()->nilai ?? 0;
      //       $sumSq += pow($nilai, 2);
      //    }

      //    $pembagi[$k->id] = $sumSq > 0 ? sqrt($sumSq) : 1;
      // }

      // return $pembagi;

      $pembagi = [];

      foreach ($kriteria as $k) {
         $jumlahKuadrat = 0;

         foreach ($penilaian as $items) {
            $row = $items->where('id_kriteria', $k->id)->first();
            $nilai = $row ? $row->nilai : 0;
            $jumlahKuadrat += pow($nilai, 2);
         }

         $pembagi[$k->id] = sqrt($jumlahKuadrat);
      }

      return $pembagi;
   }
   // menyimpan hasil ke tabel hasil_moora
   private function simpanHasilAkhir(array $hasilYi)
   {
      // hapus hasil lama
      HasilModel::truncate();

      // urutkan Yi desc
      arsort($hasilYi);

      $peringkat = 1;

      foreach ($hasilYi as $id_calon => $nilaiYi) {
         HasilModel::create([
            'id_calon'  => $id_calon,
            'nilai_yi'  => $nilaiYi,
            'peringkat' => $peringkat++
         ]);
      }
   }
}
