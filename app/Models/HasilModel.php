<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilModel extends Model
{
    //
    use HasFactory;

    protected $table = 'hasil_moora';

    protected $fillable = [
        'id_calon',
        'nilai_yi',
        'peringkat'
    ];
    // relasi ke tabel calon_majelis
    public function majelis()
    {
        return $this->belongsTo(MajelisModel::class, 'id_calon');
    }
    // relasi ke tabel proses_moora
    public function prosesMoora()
    {
        return $this->hasMany(ProsesMooraModel::class, 'id_calon');
    }
}
