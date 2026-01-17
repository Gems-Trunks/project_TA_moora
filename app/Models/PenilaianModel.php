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
}