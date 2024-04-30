<?php

namespace App\Http\Controllers;

use App\Models\Sopd;
use App\Models\Jabatan;
use App\Models\JabatanSopd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        $q_sopd = Sopd::orderBy('nama_sopd', 'asc')->get();
        $q_jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        return view('home/home', compact('q_sopd','q_jabatan'));
    }

    public function jabatan($id){
        // $idsopd = $request->id_sopd;

        // $ambilid = JabatanSopd::where('id_sopd', $idsopd)->get();
        $ambilid = JabatanSopd::where('id_sopd', $id)->get();

        $data = [];

          foreach ($ambilid as $item) {
            $jabatan = Jabatan::where('id_jabatan', $item->id_jabatan)->orderBy('nama_jabatan', 'ASC')->get();
            foreach ($jabatan as $j) {
                $data[] = $j->nama_jabatan;
            }
        }

        return response()->json($data);

        // while($data){
        //     $cek = Jabatan::where('id_jabatan', $data)->get();
        //     dd($cek);
        // }
    }
}
