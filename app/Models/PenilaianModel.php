<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianModel extends Model
{
    //
    use HasFactory;
    protected $table = "penilaian";
    protected $fillable = ['id_calon', 'id_kriteria', 'nilai'];
    // relasi ke tabel calon_majelis
    public function majelis()
    {
        return $this->belongsTo(MajelisModel::class, 'id_calon', 'id');
    }
    // relasi ke tabel kriteria
    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'id_kriteria', 'id');
    }
}
