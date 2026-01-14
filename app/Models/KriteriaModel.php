<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KriteriaModel extends Model
{
    //
    use hasfactory;
    protected $table = "kriteria";
    protected $fillable = ['nama_kriteria', 'bobot', "jenis"];
}