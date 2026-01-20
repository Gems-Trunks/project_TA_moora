<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PenilaianModel;
use App\Models\ProsesMooraModel;

class MajelisModel extends Model
{
    //
    use hasfactory;
    protected $table = 'calon_majelis';
    protected $fillable = ['nama_calon', 'jenis_kelamin', 'usia', 'lama_menjadi_jemaat'];

    // relasi ke tabel penilaian
    public function penilaian()
    {
        return $this->hasMany(PenilaianModel::class, 'id_calon');
    }
    // relasi ke tabel proses_moora
    public function prosesMoora()
    {
        return $this->hasOne(ProsesMooraModel::class, 'id_calon', 'id');
    }

    // relasi ke tabel hasil_moora
    public function hasilMoora()
    {
        return $this->hasOne(HasilModel::class, 'id_calon');
    }
}
