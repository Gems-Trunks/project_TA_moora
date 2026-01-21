<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpearmanModel extends Model
{
    //
    use HasFactory;
    protected $table = 'pengujian_spearman';
    protected $fillable = ['id_calon', 'nilai_manual', 'nilai_sistem', 'd', 'd_kuadrat'];

    public function majelis()
    {
        return $this->belongsTo(MajelisModel::class, 'id_calon', 'id');
    }

    public function hasilMoora()
    {
        return $this->belongsTo(HasilModel::class, 'id_calon', 'id_calon');
    }
}
