<?php

namespace App\Http\Controllers;

use App\Models\Sopd;
use App\Models\Jabatan;
use App\Models\JabatanSopd;
use App\Models\Unit_kerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Alert;

class homeController extends Controller
{

    // menu jabatan
        public function indexJabatanLevelSatu(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Jabatan::orderBy('jabatans.nama_jabatan', 'ASC')
            ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
            ->select(
                'jabatans.id_jabatan as id',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'jabatans.kelas as kelas_jabatan',
                'unit_kerjas.jenis_unit_kerja as unit_kerja'
            )
            ->get();

            return view('admin.jabatan.index', compact('data'));
        }

        public function addJabatanLevelSatu(){

            $unit_kerja = Unit_kerja::all();
            return view('admin.jabatan.add', compact('unit_kerja'));
        }

        public function saveJabatanLevelSatu(Request $request){

            $validasi = $request->validate([
                'nama_jabatan' => 'required|string',
                'id_unit_kerja' => 'required|integer',
                'kelas' => 'required|integer'
            ]);

            $create = Jabatan::create([
                'nama_jabatan' => $validasi['nama_jabatan'],
                'id_unit_kerja' => $validasi['id_unit_kerja'],
                'kelas' => $validasi['kelas']
            ]);

            if($create == true){
                Alert::success('Data Berhasil Ditambahkan', '');
                return redirect()->route('jabatan_sopd.index');
            }else{
                Alert::error('Data Gagal Ditambahkan', '');
                return redirect()->back();
            }
        }

        public function editJabatanLevelSatu($id){
            $data = Jabatan::findorfail($id);
            $unit_kerja = Unit_kerja::all();
            return view('admin.jabatan.edit', compact('unit_kerja','data'));
        }
        public function updateJabatanLevelSatu(Request $request, $id){
            $data = Jabatan::findorfail($id);

            $validasi = $request->validate([
                'nama_jabatan' => 'required|string',
                'id_unit_kerja' => 'required|integer',
                'kelas' => 'required|integer'
            ]);

            $update = $data->update([
                'nama_jabatan' => $validasi['nama_jabatan'],
                'id_unit_kerja' => $validasi['id_unit_kerja'],
                'kelas' => $validasi['kelas']
            ]);

            if($update == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('jabatan_sopd.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function deleteJabatanLevelSatu($id){
            $hapus = Jabatan::findorfail($id);

            $hapus->delete();
            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('jabatan_sopd.index');
        }
    // end menu jabatan





    // searching di menu home
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
    // end searching di menu home

    // fitur login & logout
    public function login()
    {
        return view('home/login');
    }
    public function login_aksi(Request $request)
    {
        $cek = array('username'=>$request->input('username'),'password'=>sha1($request->input('password')));
        $cek_hasil = Sopd::where($cek)->count();
        if($cek_hasil == null){
            Session::flush();
            Alert::error('ops!',"Username Atau Password Anda Salah");
            return redirect()->to('login');
        }
        else{
            $get_data = Sopd::where($cek)->get();
            Session::push('cek', 1);
            Session::put('id_sopd', $get_data[0]['id_sopd']);
            Session::put('username', $get_data[0]['username']);
            Session::put('nama_sopd', $get_data[0]['nama_sopd']);
            Session::put('level', $get_data[0]['level']);
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
    // end fitur login & logout
}
