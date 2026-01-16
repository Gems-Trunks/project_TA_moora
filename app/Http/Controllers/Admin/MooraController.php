<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MooraController extends Controller
{
    //
    public function indexMoora()
    {
        return view('admin.proses_moora.index');
    }

    public function showMoora()
    {
        return view('admin.proses_moora.show');
    }

    public function hitungMoora() {}
}
