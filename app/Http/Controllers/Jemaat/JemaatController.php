<?php

namespace App\Http\Controllers\Jemaat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JemaatController extends Controller
{
    //
    public function index()
    {
        return view('jemaat.dashboard');
    }
}
