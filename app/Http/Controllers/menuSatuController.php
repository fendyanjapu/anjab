<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JabatanSopd;
use App\Models\Jabatan;
use App\Models\iktisar_jabatan;
use App\Models\kualifikasi_jabatan;
use App\Models\Tugas_pokok;


use Alert;

class menuSatuController extends Controller
{
    // ini menu jabatan

    public function indexJabatan(){

        // sesuai id_sopd session
        $id_sopd = session('id_sopd');

        // list semua data
        $data = JabatanSopd::where('id_sopd', $id_sopd)
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
        ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
        ->select(
            'jabatan_sopds.id as id',
            'jabatans.id_jabatan as jabatan_id',
            'jabatans.nama_jabatan as jabatan_nama',
            'atasan.id_jabatan as atasan_id',
            'atasan.nama_jabatan as atasan_nama',
            'unit_kerjas.jenis_unit_kerja as unit_kerja'
        )
        ->orderBy('jabatans.nama_jabatan', 'ASC')
        ->get();

        return view('admin.jabatan_sopd.index', compact('data'));
    }

    public function addJabatan(){

        $jabatan = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        return view('admin.jabatan_sopd.add', compact('jabatan'));
    }

    public function saveJabatan(Request $request){

        $id_sopd = session('id_sopd');
        $validasi = $request->validate([
            'id_jabatan' => 'nullable|integer'
        ]);

        $create = JabatanSopd::create([
            'id_jabatan' => $validasi['id_jabatan'],
            'id_sopd' => $id_sopd,
            'atasan' => $request['atasan']
        ]);

        if($create == true){
            Alert::success('Data Berhasil Ditambahkan', '');
            return redirect()->route('jabatan.index');
        }else{
            Alert::error('Data Gagal Ditambahkan', '');
            return redirect()->back();
        }
    }

    public function editJabatan($id){
        $data = JabatanSopd::findorfail($id);

        $jabatan = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        return view('admin.jabatan_sopd.edit', compact('data','jabatan'));
    }

    public function updateJabatan(Request $request, $id){
        $data = JabatanSopd::findorfail($id);
        $id_sopd = session('id_sopd');

        $validasi = $request->validate([
            'id_jabatan' => 'nullable|integer'
        ]);

        $update = $data->update([
            'id_jabatan' => $validasi['id_jabatan'],
            'id_sopd' => $id_sopd,
            'atasan' => $request['atasan']
        ]);

        if($update == true){
            Alert::success('Data Berhasil Diubah', '');
            return redirect()->route('jabatan.index');
        }else{
            Alert::error('Data Gagal Diubah', '');
            return redirect()->back();
        }

    }

    public function hapusJabatan($id){
        $hapus = JabatanSopd::findorfail($id);

        $hapus->delete();
        Alert::success('Data Berhasil Dihapus', '');
        return redirect()->route('jabatan.index');
    }

    // end ini menu jabatan

    // menu Iktisar Jabatan
    public function indexIktisar(){

        // sesuai id_sopd session
        $id_sopd = session('id_sopd');

         // list semua data
         $data = iktisar_jabatan::where('id_sopd', $id_sopd)
         ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'iktisar_jabatans.id_jabatan_sopd')
         ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
         ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
         ->select(
             'iktisar_jabatans.id as id',
             'iktisar_jabatans.iktisar as iktisar',
             'jabatans.id_jabatan as jabatan_id',
             'jabatans.nama_jabatan as jabatan_nama',
             'atasan.id_jabatan as atasan_id',
             'atasan.nama_jabatan as atasan_nama',
         )
         ->orderBy('jabatans.nama_jabatan', 'ASC')
         ->get();

        return view('admin.iktisar.index', compact('data'));
    }

    public function addIktisar(){

        // sesuai id_sopd session
        $id_sopd = session('id_sopd');

        // list semua data
        $data = JabatanSopd::where('id_sopd', $id_sopd)
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
        ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
        ->select(
            'jabatan_sopds.id as id',
            'jabatans.id_jabatan as jabatan_id',
            'jabatans.nama_jabatan as jabatan_nama',
            'atasan.id_jabatan as atasan_id',
            'atasan.nama_jabatan as atasan_nama',
            'unit_kerjas.jenis_unit_kerja as unit_kerja'
        )
        ->orderBy('jabatans.nama_jabatan', 'ASC')
        ->get();

        return view('admin.iktisar.add', compact('data'));
    }
    public function saveIktisar(Request $request){
        $validasi = $request->validate([
            'id_jabatan_sopd' => 'nullable|integer',
            'iktisar' => 'nullable'
        ]);

        $create = iktisar_jabatan::create([
            'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
            'iktisar' => $validasi['iktisar']
        ]);

        if($create == true){
            Alert::success('Data Berhasil Ditambahkan', '');
            return redirect()->route('iktisar.index');
        }else{
            Alert::error('Data Gagal Ditambahkan', '');
            return redirect()->back();
        }
    }
    public function editIktisar($id){
        $data = iktisar_jabatan::findorfail($id);
        // sesuai id_sopd session
        $id_sopd = session('id_sopd');

        // list semua data
        $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
        ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
        ->select(
            'jabatan_sopds.id as id',
            'jabatans.id_jabatan as jabatan_id',
            'jabatans.nama_jabatan as jabatan_nama',
            'atasan.id_jabatan as atasan_id',
            'atasan.nama_jabatan as atasan_nama',
            'unit_kerjas.jenis_unit_kerja as unit_kerja'
        )
        ->orderBy('jabatans.nama_jabatan', 'ASC')
        ->get();

        return view('admin.iktisar.edit', compact('data','jsopd'));
    }
    public function updateIktisar(Request $request, $id){
        $id = iktisar_jabatan::findorfail($id);

        $update = $request->validate([
            'id_jabatan_sopd' => 'nullable|integer',
            'iktisar' => 'nullable'
        ]);

        $updt = $id->update([
            'id_jabatan_sopd' => $update['id_jabatan_sopd'],
            'iktisar' => $update['iktisar']
        ]);

        if($updt == true){
            Alert::success('Data Berhasil Diubah', '');
            return redirect()->route('iktisar.index');
        }else{
            Alert::error('Data Gagal Diubah', '');
            return redirect()->back();
        }
    }
    public function hapusIktisar($id){
        $id = iktisar_jabatan::findorfail($id);

        $id->delete();
        Alert::success('Data Berhasil Dihapus', '');
        return redirect()->route('iktisar.index');
    }
     // end menu Iktisar Jabatan

     public function indexKualifikasi(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = kualifikasi_jabatan::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'kualifikasi_jabatans.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'kualifikasi_jabatans.id as id',
                'kualifikasi_jabatans.pendidikan_formal as pendidikan_formal',
                'kualifikasi_jabatans.pendidikan_pelatihan as pendidikan_pelatihan',
                'kualifikasi_jabatans.pengalaman_kerja as pengalaman_kerja',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

        return view('admin.kualifikasi_jabatan.index', compact('data'));

     }
     public function addKualifikasi(){
         // sesuai id_sopd session
         $id_sopd = session('id_sopd');

         // list semua data
         $data = JabatanSopd::where('id_sopd', $id_sopd)
         ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
         ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
         ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
         ->select(
             'jabatan_sopds.id as id',
             'jabatans.id_jabatan as jabatan_id',
             'jabatans.nama_jabatan as jabatan_nama',
             'atasan.id_jabatan as atasan_id',
             'atasan.nama_jabatan as atasan_nama',
             'unit_kerjas.jenis_unit_kerja as unit_kerja'
         )
         ->orderBy('jabatans.nama_jabatan', 'ASC')
         ->get();

        return view('admin.kualifikasi_jabatan.add', compact('data'));
     }
     public function saveKualifikasi(Request $request){

        $validasi = $request->validate([
            'id_jabatan_sopd' => 'nullable|integer',
            'pendidikan_formal' => 'nullable',
            'pendidikan_pelatihan' => 'nullable',
            'pengalaman_kerja' => 'nullable',
        ]);

        $create = kualifikasi_jabatan::create([
            'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
            'pendidikan_formal' => $validasi['pendidikan_formal'],
            'pendidikan_pelatihan' => $validasi['pendidikan_pelatihan'],
            'pengalaman_kerja' => $validasi['pengalaman_kerja']
        ]);

        if($create == true){
            Alert::success('Data Berhasil Ditambahkan', '');
            return redirect()->route('kualifikasi.index');
        }else{
            Alert::error('Data Gagal Ditambahkan', '');
            return redirect()->back();
        }

     }
     public function editKualifikasi($id){

        $data = kualifikasi_jabatan::findorfail($id);
        // sesuai id_sopd session
        $id_sopd = session('id_sopd');

        // list semua data
        $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
        ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
        ->select(
            'jabatan_sopds.id as id',
            'jabatans.id_jabatan as jabatan_id',
            'jabatans.nama_jabatan as jabatan_nama',
            'atasan.id_jabatan as atasan_id',
            'atasan.nama_jabatan as atasan_nama',
            'unit_kerjas.jenis_unit_kerja as unit_kerja'
        )
        ->orderBy('jabatans.nama_jabatan', 'ASC')
        ->get();

        return view('admin.kualifikasi_jabatan.edit', compact('data','jsopd'));
     }
     public function updateKualifikasi(Request $request, $id){
        $id = kualifikasi_jabatan::findorfail($id);

        $update = $request->validate([
            'id_jabatan_sopd' => 'nullable|integer',
            'pendidikan_formal' => 'nullable',
            'pendidikan_pelatihan' => 'nullable',
            'pengalaman_kerja' => 'nullable',
        ]);

        $updt = $id->update([
            'id_jabatan_sopd' => $update['id_jabatan_sopd'],
            'pendidikan_formal' => $update['pendidikan_formal'],
            'pendidikan_pelatihan' => $update['pendidikan_pelatihan'],
            'pengalaman_kerja' => $update['pengalaman_kerja'],
        ]);

        if($updt == true){
            Alert::success('Data Berhasil Diubah', '');
            return redirect()->route('kualifikasi.index');
        }else{
            Alert::error('Data Gagal Diubah', '');
            return redirect()->back();
        }
     }
     public function hapusKualifikasi($id){

        $idhps = kualifikasi_jabatan::findorfail($id);

        $idhps->delete();
        Alert::success('Data Berhasil Dihapus', '');
        return redirect()->route('kualifikasi.index');
     }


    //  menu Tugas Pokok

    public function indexTugasPokok(){

        // sesuai id_sopd session
        $id_sopd = session('id_sopd');

        // list semua data
        $data = Tugas_pokok::where('id_sopd', $id_sopd)
        ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'tugas_pokoks.id_jabatan_sopd')
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
        ->select(
            'tugas_pokoks.id as id',
            'tugas_pokoks.uraian_tugas as uraian_tugas',
            'tugas_pokoks.hasil_kerja as hasil_kerja',
            'tugas_pokoks.jumlah_hasil as jumlah_hasil',
            'tugas_pokoks.waktu_penyelesaian_jam as waktu_penyelesaian_jam',
            'tugas_pokoks.waktu_efektif as waktu_efektif',
            'tugas_pokoks.kebutuhan_pegawai as kebutuhan_pegawai',
            'jabatans.id_jabatan as jabatan_id',
            'jabatans.nama_jabatan as jabatan_nama',
            'atasan.id_jabatan as atasan_id',
            'atasan.nama_jabatan as atasan_nama',
        )
        ->orderBy('jabatans.nama_jabatan', 'ASC')
        ->get();

        return view('admin.tugas_pokok.index', compact('data'));
    }
    public function addTugasPokok(){
          // sesuai id_sopd session
          $id_sopd = session('id_sopd');

          // list semua data
          $data = JabatanSopd::where('id_sopd', $id_sopd)
          ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
          ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
          ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
          ->select(
              'jabatan_sopds.id as id',
              'jabatans.id_jabatan as jabatan_id',
              'jabatans.nama_jabatan as jabatan_nama',
              'atasan.id_jabatan as atasan_id',
              'atasan.nama_jabatan as atasan_nama',
              'unit_kerjas.jenis_unit_kerja as unit_kerja'
          )
          ->orderBy('jabatans.nama_jabatan', 'ASC')
          ->get();

        return view('admin.tugas_pokok.add', compact('data'));
    }
    public function saveTugasPokok(Request $request){
        $validasi = $request->validate([
            'id_jabatan_sopd' => 'required|integer',
            'uraian_tugas' => 'nullable|string',
            'hasil_kerja' => 'nullable',
            'jumlah_hasil' => 'nullable|integer',
            'waktu_penyelesaian_jam' => 'nullable|integer',
            'waktu_efektif' => 'integer',
            'kebutuhan_pegawai' => 'nullable',
        ]);

        $create = Tugas_pokok::create($validasi);

        if($create == true){
            Alert::success('Data Berhasil Ditambahkan', '');
            return redirect()->route('tugasPokok.index');
        }else{
            Alert::error('Data Gagal Ditambahkan', '');
            return redirect()->back();
        }
    }
    public function editTugasPokok($id){
         $data = Tugas_pokok::findorfail($id);

          // sesuai id_sopd session
          $id_sopd = session('id_sopd');

             // list semua data
             $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
             ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
             ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
             ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'jabatans.id_unit_kerja')
             ->select(
                 'jabatan_sopds.id as id',
                 'jabatans.id_jabatan as jabatan_id',
                 'jabatans.nama_jabatan as jabatan_nama',
                 'atasan.id_jabatan as atasan_id',
                 'atasan.nama_jabatan as atasan_nama',
                 'unit_kerjas.jenis_unit_kerja as unit_kerja'
             )
             ->orderBy('jabatans.nama_jabatan', 'ASC')
             ->get();

        return view('admin.tugas_pokok.edit', compact('data','jsopd'));
    }
    public function updateTugasPokok(Request $request, $id){

        $id = Tugas_pokok::findorfail($id);

        $validasi = $request->validate([
            'id_jabatan_sopd' => 'required|integer',
            'uraian_tugas' => 'nullable|string',
            'hasil_kerja' => 'nullable',
            'jumlah_hasil' => 'nullable|integer',
            'waktu_penyelesaian_jam' => 'nullable|integer',
            'waktu_efektif' => 'integer',
            'kebutuhan_pegawai' => 'nullable',
        ]);

        $updte = $id->update($validasi);
        if($updte == true){
            Alert::success('Data Berhasil Diubah', '');
            return redirect()->route('tugasPokok.index');
        }else{
            Alert::error('Data Gagal Diubah', '');
            return redirect()->back();
        }

    }
    public function hapusTugasPokok($id){

        $hapusid = Tugas_pokok::findorfail($id);

        $hapusid->delete();
        Alert::success('Data Berhasil Dihapus', '');
        return redirect()->route('tugasPokok.index');

    }
}
