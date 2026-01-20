<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesMooraModel extends Model
{
    //
    use HasFactory;
    protected $table = 'proses_moora';
    protected $fillable = ['id_calon', 'id_kriteria', 'nilai_awal', 'nilai_normalisasi', 'nilai_bobot', 'nilai_yi'];

    // relasi ke Tabel calon_majelis
    public function majelis()
    {
        return $this->belongsTo(MajelisModel::class, "id_calon", 'id');
    }

    //relasi ke tabel kriteria
    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, "id_kriteria", 'id');
    }
    // relasi ke tabel hasil
    public function hasilMoora()
    {
        return $this->belongsTo(HasilModel::class, 'id_calon', 'id_calon');
    }
}
