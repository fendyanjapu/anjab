<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menuDuaController extends Controller
{
    //  menu Hasil Kinerja

    public function indexHasilKinerja(){

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
    public function addHasilKinerja(){
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
    public function saveHasilKinerja(Request $request){
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
    public function editHasilKinerja($id){
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
    public function updateHasilKinerja(Request $request, $id){

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
    public function hapusHasilKinerja($id){

        $hapusid = Tugas_pokok::findorfail($id);

        $hapusid->delete();
        Alert::success('Data Berhasil Dihapus', '');
        return redirect()->route('tugasPokok.index');

    }
}
