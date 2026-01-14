<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MajelisModel extends Model
{
    //
    use hasfactory;
    protected $table = 'calon_majelis';
    protected $fillable = ['nama_calon', 'jenis_kelamin', 'usia', 'lama_menjadi_jemaat'];
}