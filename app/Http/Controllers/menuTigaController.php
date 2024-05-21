<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wewenang;
use App\Models\JabatanSopd;
use App\Models\Korelasi_jabatan;
use App\Models\Kondisi_lingkungan_kerja;
use App\Models\Resiko_bahaya;

use Alert;
class menuTigaController extends Controller
{

    //  menu Tanggung Jawab
        public function indexWewenang(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Wewenang::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'wewenangs.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'wewenangs.id as id',
                'wewenangs.uraian as uraian',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.wewenang.index', compact('data'));
        }
        public function addWewenang(){
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

            return view('admin.wewenang.add', compact('data'));
        }
        public function jml_kolom_wewenang(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);

        }
        public function saveWewenang(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'uraian' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Wewenang::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'uraian' => $validasi['uraian'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('Wewenang.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Wewenang::create([
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                        'uraian' => $validasi['uraian'][$i],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('Wewenang.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editWewenang($id){
            $data = Wewenang::findorfail($id);

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

            return view('admin.wewenang.edit', compact('data','jsopd'));
        }
        public function updateWewenang(Request $request, $id){

            $id = Wewenang::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'uraian' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('Wewenang.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusWewenang($id){

            $hapusid =  Wewenang::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('Wewenang.index');
        }
    //  menu Tanggung Jawab

    //  menu Korelasi Jabatan
        public function indexKorelasiJabatan(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Korelasi_jabatan::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'korelasi_jabatans.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'korelasi_jabatans.id as id',
                'korelasi_jabatans.nm_jabatan as nm_jabatan',
                'korelasi_jabatans.unit_kerja_instansi as unit_kerja_instansi',
                'korelasi_jabatans.dalam_hal as dalam_hal',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.korelasi_jabatan.index', compact('data'));
        }
        public function addKorelasiJabatan(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = jabatanSopd::where('id_sopd', $id_sopd)
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

            return view('admin.korelasi_jabatan.add', compact('data'));
        }
        public function jml_kolom_korelasi(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);
        }
        public function saveKorelasiJabatan(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'nm_jabatan' => 'nullable',
                'unit_kerja_instansi' => 'nullable',
                'dalam_hal' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Korelasi_jabatan::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'nm_jabatan' => $validasi['nm_jabatan'],
                    'unit_kerja_instansi' => $validasi['unit_kerja_instansi'],
                    'dalam_hal' => $validasi['dalam_hal'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('KorelasiJabatan.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Korelasi_jabatan::create([
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                        'nm_jabatan' => $validasi['nm_jabatan'][$i],
                        'unit_kerja_instansi' => $validasi['unit_kerja_instansi'][$i],
                        'dalam_hal' => $validasi['dalam_hal'][$i],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('KorelasiJabatan.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editKorelasiJabatan($id){
            $data = Korelasi_jabatan::findorfail($id);

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

            return view('admin.korelasi_jabatan.edit', compact('data','jsopd'));
        }
        public function updateKorelasiJabatan(Request $request, $id){

            $id = Korelasi_jabatan::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'nm_jabatan' => 'nullable',
                'unit_kerja_instansi' => 'nullable',
                'dalam_hal' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('KorelasiJabatan.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusKorelasiJabatan($id){

            $hapusid =  Korelasi_jabatan::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('KorelasiJabatan.index');
        }
    //  menu Korelasi Jabatan

    //  menu kondisi Lingkungan Kerja
        public function indexKondisiLingkunganKerja(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Kondisi_lingkungan_kerja::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'Kondisi_lingkungan_kerjas.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'Kondisi_lingkungan_kerjas.id as id',
                'Kondisi_lingkungan_kerjas.aspek as aspek',
                'Kondisi_lingkungan_kerjas.faktor as faktor',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.kondisi_lingkungan_kerja.index', compact('data'));
        }
        public function addKondisiLingkunganKerja(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = jabatanSopd::where('id_sopd', $id_sopd)
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

            return view('admin.kondisi_lingkungan_kerja.add', compact('data'));
        }
        public function jml_kolom_kondisi_lingkungan_kerja(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);
        }
        public function saveKondisiLingkunganKerja(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'aspek' => 'nullable',
                'faktor' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Kondisi_lingkungan_kerja::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'aspek' => $validasi['aspek'],
                    'faktor' => $validasi['faktor'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('KondisiLingkunganKerja.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Kondisi_lingkungan_kerja::create([
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                        'aspek' => $validasi['aspek'][$i],
                        'faktor' => $validasi['faktor'][$i],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('KondisiLingkunganKerja.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editKondisiLingkunganKerja($id){
            $data = Kondisi_lingkungan_kerja::findorfail($id);

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

            return view('admin.kondisi_lingkungan_kerja.edit', compact('data','jsopd'));
        }
        public function updateKondisiLingkunganKerja(Request $request, $id){

            $id = Kondisi_lingkungan_kerja::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'aspek' => 'nullable',
                'faktor' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('KondisiLingkunganKerja.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusKondisiLingkunganKerja($id){

            $hapusid =  Kondisi_lingkungan_kerja::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('KondisiLingkunganKerja.index');
        }
    //  menu kondisi Lingkungan Kerja

    //  menu Resiko Bahaya
        public function indexResikoBahaya(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Resiko_bahaya::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'resiko_bahayas.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'resiko_bahayas.id as id',
                'resiko_bahayas.nama_resiko as nama_resiko',
                'resiko_bahayas.penyebab as penyebab',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.resiko_bahaya.index', compact('data'));
        }
        public function addResikoBahaya(){
            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = jabatanSopd::where('id_sopd', $id_sopd)
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

            return view('admin.resiko_bahaya.add', compact('data'));
        }
        public function jml_kolom_resiko_bahaya(Request $request){
            $jml = $request->jml;

            return response()->json(['result' => $jml]);
        }
        public function saveResikoBahaya(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'nama_resiko' => 'nullable',
                'penyebab' => 'nullable',
            ]);

            if($validasi['jumlah_kolom'] == 1){
                $create = Resiko_bahaya::create([
                    'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                    'nama_resiko' => $validasi['nama_resiko'],
                    'penyebab' => $validasi['penyebab'],
                ]);
                if($create == true){
                    Alert::success('Data Berhasil Ditambahkan', '');
                    return redirect()->route('ResikoBahaya.index');
                }else{
                    Alert::error('Data Gagal Ditambahkan', '');
                    return redirect()->back();
                }
            }else{
                for ($i = 0; $i < $validasi['jumlah_kolom']; $i++) {
                    $create = Resiko_bahaya::create([
                        'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                        'nama_resiko' => $validasi['nama_resiko'][$i],
                        'penyebab' => $validasi['penyebab'][$i],
                    ]);
                }
                    if($create == true){
                        Alert::success('Data Berhasil Ditambahkan', '');
                        return redirect()->route('ResikoBahaya.index');
                    }else{
                        Alert::error('Data Gagal Ditambahkan', '');
                        return redirect()->back();
                    }
            }
        }
        public function editResikoBahaya($id){
            $data = Resiko_bahaya::findorfail($id);

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

            return view('admin.resiko_bahaya.edit', compact('data','jsopd'));
        }
        public function updateResikoBahaya(Request $request, $id){

            $id = Resiko_bahaya::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'jumlah_kolom' => 'integer',
                'nama_resiko' => 'nullable',
                'penyebab' => 'nullable',
            ]);

            $updte = $id->update($validasi);
            if($updte == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('ResikoBahaya.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusResikoBahaya($id){

            $hapusid =  Resiko_bahaya::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('ResikoBahaya.index');
        }
    //  menu Resiko Bahaya
}
