<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sopd;
use App\Models\Jabatan;

class homeController extends Controller
{
    public function index()
    {
        $q_sopd = Sopd::all();
        $q_jabatan = Jabatan::all();
        return view('home/home', compact('q_sopd','q_jabatan'));
    }
}
