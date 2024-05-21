<?php

namespace App\Http\Controllers;

use App\Models\Hasil_kerja;
use App\Models\JabatanSopd;
use App\Models\Bahan_kerja;
use App\Models\Perangkat_kerja;
use App\Models\Tanggung_jawab;
use Illuminate\Http\Request;

use Alert;

class menuDuaController extends Controller
{
    //  menu Hasil Kerja
        public function indexHasilKerja(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Hasil_kerja::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'hasil_kerjas.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'hasil_kerjas.id as id',
                'hasil_kerjas.hasil as hasil',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.hasil_kerja.index', compact('data'));
        }
        public function addHasilKerja(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = JabatanSopd::where('id_sopd', $id_sopd)
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'jabatan_sopds.id as id',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.hasil_kerja.add', compact('data'));
        }
        public function jml_kolom(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);

        }
        public function saveHasilKerja(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'hasil' => 'nullable'
           ]);
           if($validasi['jumlah_kolom'] == 1){
                $create = Hasil_kerja::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'hasil' => $validasi['hasil'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('hasilKerja.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
           }
           else{
            for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                $create = Hasil_kerja::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'hasil' => $validasi['hasil'][$i],
                ]);
            }
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('hasilKerja.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
           }

        }
        public function editHasilKerja($id){
            $data = Hasil_kerja::findorfail($id);

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

                // list semua data
                $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
                ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
                ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
                ->select(
                    'jabatan_sopds.id as id',
                    'jabatans.id_jabatan as jabatan_id',
                    'jabatans.nama_jabatan as jabatan_nama',
                    'atasan.id_jabatan as atasan_id',
                    'atasan.nama_jabatan as atasan_nama',
                )
                ->orderBy('jabatans.nama_jabatan', 'ASC')
                ->get();

            return view('admin.hasil_kerja.edit', compact('data','jsopd'));
        }
        public function updateHasilKerja(Request $request, $id){

            $id = Hasil_kerja::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'hasil' => 'nullable'
           ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('hasilKerja.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusHasilKerja($id){

            $hapusid =  Hasil_kerja::findorfail($id);

            $hapusid->delete();
            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('hasilKerja.index');

        }
    //  menu Hasil Kerja

    //  menu Bahan Kerja
        public function indexBahanKerja(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Bahan_kerja::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'bahan_kerjas.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'bahan_kerjas.id as id',
                'bahan_kerjas.bahan_kerja as bahan_kerja',
                'bahan_kerjas.penggunaan_dalam_tugas as penggunaan_dalam_tugas',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->orderBy('bahan_kerjas.bahan_kerja', 'ASC')
            ->get();

            return view('admin.bahan_kerja.index', compact('data'));
        }
        public function addBahanKerja(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = JabatanSopd::where('id_sopd', $id_sopd)
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'jabatan_sopds.id as id',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.bahan_kerja.add', compact('data'));
        }
        public function jml_kolom_bahan_kerja(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);

        }
        public function saveBahanKerja(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'bahan_kerja' => 'nullable',
                'penggunaan_dalam_tugas' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Bahan_kerja::create([
                    'bahan_kerja' => $validasi['bahan_kerja'],
                    'penggunaan_dalam_tugas' => $validasi['penggunaan_dalam_tugas'],
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('bahanKerja.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Bahan_kerja::create([
                        'bahan_kerja' => $validasi['bahan_kerja'][$i],
                        'penggunaan_dalam_tugas' => $validasi['penggunaan_dalam_tugas'][$i],
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('bahanKerja.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editBahanKerja($id){
            $data = Bahan_kerja::findorfail($id);

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

                // list semua data
                $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
                ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
                ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
                ->select(
                    'jabatan_sopds.id as id',
                    'jabatans.id_jabatan as jabatan_id',
                    'jabatans.nama_jabatan as jabatan_nama',
                    'atasan.id_jabatan as atasan_id',
                    'atasan.nama_jabatan as atasan_nama',
                )
                ->orderBy('jabatans.nama_jabatan', 'ASC')
                ->get();

            return view('admin.bahan_kerja.edit', compact('data','jsopd'));
        }
        public function updateBahanKerja(Request $request, $id){

            $id = Bahan_kerja::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'bahan_kerja' => 'nullable',
                'penggunaan_dalam_tugas' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('bahanKerja.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusBahanKerja($id){

            $hapusid =  Bahan_kerja::findorfail($id);

            $hapusid->delete();
            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('bahanKerja.index');

        }
    //  menu Bahan Kerja

    //  menu Perangkat Kerja
        public function indexPerangkatKerja(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Perangkat_kerja::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'perangkat_kerjas.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'perangkat_kerjas.id as id',
                'perangkat_kerjas.perangkat_kerja as perangkat_kerja',
                'perangkat_kerjas.penggunaan_untuk_tugas as penggunaan_untuk_tugas',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.perangkat_kerja.index', compact('data'));
        }
        public function addPerangkatKerja(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = JabatanSopd::where('id_sopd', $id_sopd)
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'jabatan_sopds.id as id',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.perangkat_kerja.add', compact('data'));
        }
        public function jml_kolom_Perangkat_kerja(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);

        }
        public function savePerangkatKerja(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'perangkat_kerja' => 'nullable',
                'penggunaan_untuk_tugas' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Perangkat_kerja::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'perangkat_kerja' => $validasi['perangkat_kerja'],
                    'penggunaan_untuk_tugas' => $validasi['penggunaan_untuk_tugas'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('perangkatKerja.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Perangkat_kerja::create([
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                        'perangkat_kerja' => $validasi['perangkat_kerja'][$i],
                        'penggunaan_untuk_tugas' => $validasi['penggunaan_untuk_tugas'][$i],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('perangkatKerja.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editPerangkatKerja($id){
            $data = Perangkat_kerja::findorfail($id);

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

                // list semua data
                $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
                ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
                ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
                ->select(
                    'jabatan_sopds.id as id',
                    'jabatans.id_jabatan as jabatan_id',
                    'jabatans.nama_jabatan as jabatan_nama',
                    'atasan.id_jabatan as atasan_id',
                    'atasan.nama_jabatan as atasan_nama',
                )
                ->orderBy('jabatans.nama_jabatan', 'ASC')
                ->get();

            return view('admin.perangkat_kerja.edit', compact('data','jsopd'));
        }
        public function updatePerangkatKerja(Request $request, $id){

            $id = Perangkat_kerja::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'perangkat_kerja' => 'nullable',
                'penggunaan_untuk_tugas' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('perangkatKerja.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusPerangkatKerja($id){

            $hapusid =  perangkat_kerja::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('perangkatKerja.index');
        }
    //  menu Perangkat Kerja

    //  menu Tanggung Jawab
        public function indexTanggungJawab(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Tanggung_jawab::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'tanggung_jawabs.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'tanggung_jawabs.id as id',
                'tanggung_jawabs.uraian as uraian',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.tanggung_jawab.index', compact('data'));
        }
        public function addTanggungJawab(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = JabatanSopd::where('id_sopd', $id_sopd)
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'jabatan_sopds.id as id',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.tanggung_jawab.add', compact('data'));
        }
        public function jml_kolom_tanggung_jawab(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);

        }
        public function saveTanggungJawab(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'uraian' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Tanggung_jawab::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'uraian' => $validasi['uraian'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('tanggungJawab.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Tanggung_jawab::create([
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                        'uraian' => $validasi['uraian'][$i],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('tanggungJawab.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editTanggungJawab($id){
            $data = Tanggung_jawab::findorfail($id);

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

                // list semua data
                $jsopd = JabatanSopd::where('id_sopd', $id_sopd)
                ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
                ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
                ->select(
                    'jabatan_sopds.id as id',
                    'jabatans.id_jabatan as jabatan_id',
                    'jabatans.nama_jabatan as jabatan_nama',
                    'atasan.id_jabatan as atasan_id',
                    'atasan.nama_jabatan as atasan_nama',
                )
                ->orderBy('jabatans.nama_jabatan', 'ASC')
                ->get();

            return view('admin.tanggung_jawab.edit', compact('data','jsopd'));
        }
        public function updateTanggungJawab(Request $request, $id){

            $id = Tanggung_jawab::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'uraian' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('tanggungJawab.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusTanggungJawab($id){

            $hapusid =  Tanggung_jawab::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('tanggungJawab.index');
        }
    //  menu Tanggung Jawab

}
