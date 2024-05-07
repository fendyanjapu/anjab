<?php

namespace App\Http\Controllers;

use App\Models\Sopd;
use App\Models\Jabatan;
use App\Models\JabatanSopd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Alert;

class homeController extends Controller
{
    public function index()
    {
        $q_sopd = Sopd::orderBy('nama_sopd', 'asc')->get();
        $q_jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        return view('home/home', compact('q_sopd','q_jabatan'));
    }

    public function jabatan(Request $request){

        $id = $request->id_sopd;

        $ambilid = JabatanSopd::where('id_sopd', $id)->get();
        $data = [];
          foreach ($ambilid as $item) {
            $jabatan = Jabatan::where('id_jabatan', $item->id_jabatan)
            ->get();
            foreach ($jabatan as $j) {
                $data[] = array(
                    'id_jabatan' => $j->id_jabatan,
                    'nama_jabatan' => $j->nama_jabatan,
                );
            }
        }
        return response()->json($data);
    }

    public function cari(Request $request){

        $id_sopd = $request->id_sopd;
        $id_jabatan = $request->id_jabatan;

        $data = JabatanSopd::with('Relsopd','RelJab')
        ->leftJoin('sopds', 'sopds.id_sopd', '=', 'jabatan_sopds.id_sopd')
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan');

        if($id_sopd != "" && $id_jabatan != ""){
            $data->where('jabatan_sopds.id_sopd', $id_sopd)
            ->where('jabatan_sopds.id_jabatan', $id_jabatan)
            ;
        }

        elseif($id_sopd != ""){
            $data->where('jabatan_sopds.id_sopd', $id_sopd);
        }
        elseif($id_jabatan != ""){
            $data->where('jabatan_sopds.id_jabatan', $id_jabatan);
        }

        $data->orderBy('nama_sopd', 'ASC');
        $data->orderBy('nama_jabatan', 'ASC');
        $hasil = $data->paginate(50);

        return response()->json($hasil);

    }
    public function login()
    {
        return view('home/login');
    }
    public function login_aksi(Request $request)
    {
        $cek = array('username'=>$request->input('username'),'password'=>sha1($request->input('password')));
        $get_data = Sopd::where($cek)->get();
        $level = $get_data[0]['level'];
        $cek_hasil = Sopd::where($cek)->count();
        if($cek_hasil == null){
            Session::flush();
            Alert::error('ops!',"Username Atau Password Anda Salah");
            return redirect()->to('login');
        }
        else{
            Session::push('cek', 1);
            Session::push('level', $level);
            toast('Anda berhasil login','success');
            return redirect()->to('admin');
        }
    }
    public function logout()
    {
        Session::flush();
        Alert::success('Hore!',"Anda berhasil logout");
        return redirect()->to('login');
    }
}
