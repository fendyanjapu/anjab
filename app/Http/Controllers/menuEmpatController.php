<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sopd;
use App\Models\Syarat_jabatan;
use App\Models\jabatanSopd;
use App\Models\Prestasi_kerja_yang_diharapkan;

use Alert;

class menuEmpatController extends Controller
{

    //  menu syarat jabatan
        public function indexSyaratJabatan(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Syarat_jabatan::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'syarat_jabatans.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'syarat_jabatans.*',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.syarat_jabatan.index', compact('data'));
        }
        public function addSyaratJabatan(){
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

            return view('admin.syarat_jabatan.add', compact('data'));
        }
        public function saveSyaratJabatan(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'keterampilan_kerja' => 'nullable|string',
                'bakat_kerja' => 'nullable|array',
                'temperamen_kerja' => 'nullable|array',
                'minat_kerja' => 'nullable|array',
                'upaya_fisik' => 'nullable|array',
                'jenis_kelamin' => 'nullable',
                'umur' => 'nullable',
                'tinggi_badan' => 'nullable',
                'berat_badan' => 'nullable',
                'postur_badan' => 'nullable',
                'penampilan' => 'nullable',
                'fungsi_pekerjaan' => 'nullable|array',
            ]);

            $bakat_kerja = str_replace('"',"",json_encode(implode(" - ", $validasi['bakat_kerja'])));
            $temperamen_kerja = str_replace('"',"",json_encode(implode(" - ", $validasi['temperamen_kerja'])));
            $minat_kerja = str_replace('"',"",json_encode(implode(" - ", $validasi['minat_kerja'])));
            $upaya_fisik = str_replace('"',"",json_encode(implode(" - ", $validasi['upaya_fisik'])));
            $fungsi_pekerjaan = str_replace('"',"",json_encode(implode(" - ", $validasi['fungsi_pekerjaan'])));

            $create = Syarat_jabatan::create([
                'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                'keterampilan_kerja' => $validasi['keterampilan_kerja'],
                'bakat_kerja' => $bakat_kerja,
                'temperamen_kerja' =>  $temperamen_kerja,
                'minat_kerja' => $minat_kerja,
                'upaya_fisik' =>  $upaya_fisik,
                'jenis_kelamin' => $validasi['jenis_kelamin'],
                'umur' => $validasi['umur'],
                'tinggi_badan' => $validasi['tinggi_badan'],
                'berat_badan' => $validasi['berat_badan'],
                'postur_badan' => $validasi['postur_badan'],
                'penampilan' => $validasi['penampilan'],
                'fungsi_pekerjaan' =>  $fungsi_pekerjaan,
            ]);

            if($create == true){
                Alert::success('Data Berhasil Ditambahkan', '');
                return redirect()->route('SyaratJabatan.index');
            }else{
                Alert::error('Data Gagal Ditambahkan', '');
                return redirect()->back();
            }
        }
        public function editSyaratJabatan($id){
            $data = Syarat_jabatan::findorfail($id);

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

                $bk = explode(' - ',$data->bakat_kerja);
                $tk = explode(' - ',$data->temperamen_kerja);
                $mk = explode(' - ',$data->minat_kerja);
                $uf = explode(' - ',$data->upaya_fisik);
                $fp = explode(' - ',$data->fungsi_pekerjaan);


            return view('admin.syarat_jabatan.edit', compact('data','jsopd','bk','tk','mk','uf','fp'));
        }
        public function updateSyaratJabatan(Request $request, $id){

            $id = Syarat_jabatan::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'keterampilan_kerja' => 'nullable|string',
                'bakat_kerja' => 'nullable|array',
                'temperamen_kerja' => 'nullable|array',
                'minat_kerja' => 'nullable|array',
                'upaya_fisik' => 'nullable|array',
                'jenis_kelamin' => 'nullable',
                'umur' => 'nullable',
                'tinggi_badan' => 'nullable',
                'berat_badan' => 'nullable',
                'postur_badan' => 'nullable',
                'penampilan' => 'nullable',
                'fungsi_pekerjaan' => 'nullable|array',
            ]);

            $bakat_kerja = str_replace('"',"",json_encode(implode(" - ", $validasi['bakat_kerja'])));
            $temperamen_kerja = str_replace('"',"",json_encode(implode(" - ", $validasi['temperamen_kerja'])));
            $minat_kerja = str_replace('"',"",json_encode(implode(" - ", $validasi['minat_kerja'])));
            $upaya_fisik = str_replace('"',"",json_encode(implode(" - ", $validasi['upaya_fisik'])));
            $fungsi_pekerjaan = str_replace('"',"",json_encode(implode(" - ", $validasi['fungsi_pekerjaan'])));

            $update = $id->update([
                'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                'keterampilan_kerja' => $validasi['keterampilan_kerja'],
                'bakat_kerja' => $bakat_kerja,
                'temperamen_kerja' =>  $temperamen_kerja,
                'minat_kerja' => $minat_kerja,
                'upaya_fisik' =>  $upaya_fisik,
                'jenis_kelamin' => $validasi['jenis_kelamin'],
                'umur' => $validasi['umur'],
                'tinggi_badan' => $validasi['tinggi_badan'],
                'berat_badan' => $validasi['berat_badan'],
                'postur_badan' => $validasi['postur_badan'],
                'penampilan' => $validasi['penampilan'],
                'fungsi_pekerjaan' =>  $fungsi_pekerjaan,
            ]);

            if($update == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('SyaratJabatan.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusSyaratJabatan($id){

            $hapusid =  Syarat_jabatan::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('SyaratJabatan.index');
        }
    //  menu syarat jabatan

    // menu prestasi kerja
        public function indexPrestasiKerja(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
            $data = Prestasi_kerja_yang_diharapkan::where('id_sopd', $id_sopd)
            ->leftJoin('jabatan_sopds', 'jabatan_sopds.id', '=', 'prestasi_kerja_yang_diharapkans.id_jabatan_sopd')
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
            ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
            ->select(
                'prestasi_kerja_yang_diharapkans.*',
                'jabatans.id_jabatan as jabatan_id',
                'jabatans.nama_jabatan as jabatan_nama',
                'atasan.id_jabatan as atasan_id',
                'atasan.nama_jabatan as atasan_nama',
            )
            ->orderBy('jabatans.nama_jabatan', 'ASC')
            ->get();

            return view('admin.prestasi_kerja_yang_diharapkan.index', compact('data'));
        }
        public function addPrestasiKerja(){
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

            return view('admin.prestasi_kerja_yang_diharapkan.add', compact('data'));
        }
        public function savePrestasiKerja(Request $request){

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'prestasi' => 'nullable',

            ]);
            $create = Prestasi_kerja_yang_diharapkan::create([
                'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                'prestasi' => $validasi['prestasi'],
            ]);

            if($create == true){
                Alert::success('Data Berhasil Ditambahkan', '');
                return redirect()->route('PrestasiKerja.index');
            }else{
                Alert::error('Data Gagal Ditambahkan', '');
                return redirect()->back();
            }
        }
        public function editPrestasiKerja($id){
            $data = Prestasi_kerja_yang_diharapkan::findorfail($id);

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

            return view('admin.prestasi_kerja_yang_diharapkan.edit', compact('data','jsopd'));
        }
        public function updatePrestasiKerja(Request $request, $id){

            $id = Prestasi_kerja_yang_diharapkan::findorfail($id);

            $validasi = $request->validate([
                'id_jabatan_sopd' => 'nullable|integer',
                'prestasi' => 'nullable',
            ]);

            $update = $id->update([
                'id_jabatan_sopd' => $validasi['id_jabatan_sopd'],
                'prestasi' => $validasi['prestasi'],
            ]);

            if($update == true){
                Alert::success('Data Berhasil Diubah', '');
                return redirect()->route('PrestasiKerja.index');
            }else{
                Alert::error('Data Gagal Diubah', '');
                return redirect()->back();
            }

        }
        public function hapusPrestasiKerja($id){

            $hapusid =  Prestasi_kerja_yang_diharapkan::findorfail($id);
            $hapusid->delete();

            Alert::success('Data Berhasil Dihapus', '');
            return redirect()->route('PrestasiKerja.index');
        }
    // menu prestasi kerja

    // menu kelas jabatan & pengaturan
        public function IndexKelasJabatan(){

            // sesuai id_sopd session
            $id_sopd = session('id_sopd');

            // list semua data
        // list semua data
        $data = JabatanSopd::where('id_sopd', $id_sopd)
        ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftJoin('jabatans as atasan', 'atasan.id_jabatan', '=', 'jabatan_sopds.atasan')
        ->select(
            'jabatan_sopds.id as id',
            'jabatans.id_jabatan as jabatan_id',
            'jabatans.nama_jabatan as jabatan_nama',
            'jabatans.kelas as kelas',
        )
        ->orderBy('jabatans.nama_jabatan', 'ASC')
        ->get();

            return view('admin.kelas_jabatan.index', compact('data'));
        }
        public function IndexResetPassword(){

            $username = session('username');
            return view('admin.reset_password.pengaturan', compact('username'));
        }
        public function Ubah_Password(Request $request){

            $validasi = $request->validate(
                    [
                        'username' => 'required',
                        'password_lama' => 'required',
                        'password_baru' => 'required',
                    ]
            );

            $passlama = sha1($validasi['password_lama']);
            $passbaru = sha1($validasi['password_baru']);

            $selectUser = Sopd::where(
                'username', $validasi['username']
                )->where('password', $passlama)
                ->select(
                    'sopds.id_sopd as id_sopd',
                    'sopds.password as password',
                )->first();

                if($selectUser != null){
                    $id_sopd = Sopd::where('id_sopd', $selectUser->id_sopd);
                    $update = $id_sopd->update([
                        'password' => $passbaru
                    ]);

                    if($update == true){
                        Alert::success('Password Anda Telah berganti', '');
                        return redirect()->route('ResetPassword');
                    }
                    else{
                        Alert::error('Gagal Merubah Password', '');
                        return redirect()->back();
                    }
                }else{
                    Alert::error('Password Tidak Sama', '');
                    return redirect()->back();
                }


            }
        }
    // menu pengaturan
