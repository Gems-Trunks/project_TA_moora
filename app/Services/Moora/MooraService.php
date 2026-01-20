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
      $penilaian = PenilaianModel::get()->groupBy('id_calon');
      $kriteria = KriteriaModel::all();

      // 1. Hitung pembagi (normalisasi)
      $pembagi = $this->hitungPembagi($penilaian, $kriteria);

      // 2. Proses per calon
      foreach ($penilaian as $id_calon => $items) {
         $totalBenefit = 0;
         $totalCost = 0;

         // loop perhitungan moora
         foreach ($kriteria as $index => $k) {
            $row = $items->where('id_kriteria', $k->id)->first();

            $nilaiAwal = $row ? $row->nilai : 0;
            $normalisasi = $nilaiAwal / $pembagi[$k->id];
            $nilaiBobot = $normalisasi * $k->bobot;

            if (strtolower($k->jenis) === 'cost') {
               $totalCost += $nilaiBobot;
            } else {
               $totalBenefit += $nilaiBobot;
            }

            $isLast = $index === ($kriteria->count() - 1);

            ProsesMooraModel::updateOrCreate(
               [
                  'id_calon' => $id_calon,
                  'id_kriteria' => $k->id
               ],
               [
                  'nilai_awal' => $nilaiAwal,
                  'nilai_normalisasi' => $normalisasi,
                  'nilai_bobot' => $nilaiBobot,
                  'nilai_yi' => $isLast ? ($totalBenefit - $totalCost) : null
               ]
            );
         }
      }
      $hasilYi = [];

      // hitung nilai Yi per calon
      foreach ($penilaian as $id_calon => $items) {
         $hasilYi[$id_calon] = $totalBenefit - $totalCost;
      }

      // simpan ke tabel hasil_moora
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
      $pembagi = [];

      foreach ($kriteria as $k) {
         $sumSq = 0;

         foreach ($penilaian as $items) {
            $nilai = $items->where('id_kriteria', $k->id)->first()->nilai ?? 0;
            $sumSq += pow($nilai, 2);
         }

         $pembagi[$k->id] = $sumSq > 0 ? sqrt($sumSq) : 1;
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
