<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisSimpananController extends Controller
{
    public function index(){
        return view('jenis');
    }
}
