<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menuSatuController extends Controller
{
    // ini menu jabatan

    public function indexJabatan(){
        return view('jabatan_sopd.index');
    }


    // end ini menu jabatan
}
