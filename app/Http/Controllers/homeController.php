<?php

namespace App\Http\Controllers;

use App\Models\Sopd;
use App\Models\Jabatan;
use App\Models\JabatanSopd;
use App\Models\Unit_kerja;
use App\Models\iktisar_jabatan;
use App\Models\Kualifikasi_jabatan;
use App\Models\Tugas_pokok;
use App\Models\Hasil_kerja;
use App\Models\Bahan_kerja;
use App\Models\Perangkat_kerja;
use App\Models\Wewenang;
use App\Models\Tanggung_jawab;
use App\Models\Korelasi_jabatan;
use App\Models\Kondisi_lingkungan_kerja;
use App\Models\Resiko_bahaya;
use App\Models\Syarat_jabatan;
use App\Models\s_bakat_kerja;
use App\Models\s_temperamen_kerja;
use App\Models\s_minat_kerja;
use App\Models\s_upaya_fisik;
use App\Models\s_fungsi_pekerjaan;
use App\Models\Prestasi_kerja_yang_diharapkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use Codedge\Fpdf\Fpdf\Fpdf;

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

    // informasi jabatan
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function informasi_jabatan($id){


        $pdf = new FPDF('p','mm','A4');
		$pdf->AddPage();
		// $pdf->SetFillColor(133, 209, 252);
		$pdf->SetFont('Arial','B',16);
		// $pdf->Image(base_url('assets/img/download.png'),5,5,30,30);

        $query1 = JabatanSopd::where('id', $id)
        ->leftjoin('sopds', 'sopds.id_sopd', '=', 'jabatan_sopds.id_sopd')
        ->get();

        foreach($query1 as $itemQuery1){
            $nama_sopd = $itemQuery1->nama_sopd;
        }
		$pdf->SetFont("", "B", 13);
		$pdf->Cell(0,7,'INFORMASI JABATAN',0,1,'C');
		$pdf->SetFont("", "", 13);
		$pdf->Cell(0,7,$nama_sopd,0,1,'C');
		$pdf->Ln(5);
		$pdf->SetFont('','',10);

        // jabatan
        $query2 = JabatanSopd::where('jabatan_sopds.id', $id)
        ->leftjoin('jabatans', 'jabatans.id_jabatan', '=', 'jabatan_sopds.id_jabatan')
        ->leftjoin('unit_kerjas', 'jabatans.id_unit_kerja', '=', 'unit_kerjas.id');
        // ->get();


        if($query2->count() > 0){
            foreach($query2->get() as $itemQuery2){
                $nama_jabatan = $itemQuery2->nama_jabatan;
                $jenis_unit_kerja = $itemQuery2->jenis_unit_kerja;
                $kelas = $itemQuery2->kelas;
            }
        }
        else{
            $nama_jabatan = "";
			$jenis_unit_kerja = "";
			$kelas = "";
        }

        $query3 = iktisar_jabatan::where('id_jabatan_sopd', $id);
        if($query3->count() > 0){
            foreach($query3->get() as $itemQuery3){
                $iktisar = $itemQuery3->iktisar;
            }
        }else{
            $iktisar = "";
        }

        $query4 = Kualifikasi_jabatan::where('id_jabatan_sopd', $id);
        if($query4->count() > 0){
            foreach ($query4->get() as $itemQuery4) {
                $pendidikan_formal = $itemQuery4->pendidikan_formal;
                $pendidikan_pelatihan = $itemQuery4->pendidikan_pelatihan;
                $pengalaman_kerja = $itemQuery4->pengalaman_kerja;
            }
        }else{
            $pendidikan_formal = "";
            $pendidikan_pelatihan = "";
            $pengalaman_kerja = "";
        }

		$pdf->Cell(50,6,'1. NAMA JABATAN',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$nama_jabatan,0,1,'');
		$pdf->Cell(50,6,'2. KODE JABATAN',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,'',0,1,'');
		$pdf->Cell(50,6,'3. UNIT KERJA',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$jenis_unit_kerja,0,1,'');
		$pdf->Cell(50,6,'4. IKTISAR JABATAN',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');

		$cellWidth=140; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth($iktisar) < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen($iktisar);	//total panjang teks
			$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)
        }
			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($iktisar,$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$iktisar,0);

		//kembalikan posisi untuk sel berikutnya di samping MultiCell
		//dan offset x dengan lebar MultiCell
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(50,($line * $cellHeight),'',0,1,'');

		$pdf->Cell(50,6,'5. KUALIFIKASI JABATAN',0,1,'');
		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(46,6,'a. Pendidikan Formal',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');

		$cellWidth=140; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth($pendidikan_formal) < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen($pendidikan_formal);	//total panjang teks
			$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($pendidikan_formal,$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

		//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$pendidikan_formal,0);

		//kembalikan posisi untuk sel berikutnya di samping MultiCell
		//dan offset x dengan lebar MultiCell
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(50,($line * $cellHeight),'',0,1,'');

		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(46,6,'b. Pendidikan Pelatihan',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');

		$cellWidth=140; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth($pendidikan_pelatihan) < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen($pendidikan_pelatihan);	//total panjang teks
			$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($pendidikan_pelatihan,$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$pendidikan_pelatihan,0);

		//kembalikan posisi untuk sel berikutnya di samping MultiCell
			//dan offset x dengan lebar MultiCell
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(50,($line * $cellHeight),'',0,1,'');

		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(46,6,'c. Pengalaman Kerja',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		// $pdf->Cell(80,6,$pengalaman_kerja,0,1,'');
		$cellWidth=140; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth($pengalaman_kerja) < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen($pengalaman_kerja);	//total panjang teks
			$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($pengalaman_kerja,$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$pengalaman_kerja,0);

		//kembalikan posisi untuk sel berikutnya di samping MultiCell
			//dan offset x dengan lebar MultiCell
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(50,($line * $cellHeight),'',0,1,'');

		$pdf->Cell(50,6,'6. TUGAS POKOK',0,1,'');

		$cellWidth=23; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth('SATUAN HASIL') < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen('SATUAN HASIL');	//total panjang teks
			$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr('SATUAN HASIL',$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(10,($line * $cellHeight),'NO',1,0,'C');
		$pdf->Cell(70,($line * $cellHeight),'URAIAN TUGAS',1,0,'C');
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,'SATUAN HASIL',1,'C');
		$pdf->SetXY($xPos + $cellWidth , $yPos);

		$cellWidth=20; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth('JUMLAH HASIL') < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen('JUMLAH HASIL');	//total panjang teks
			$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr('JUMLAH HASIL',$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,'JUMLAH HASIL',1,'C');
		$pdf->SetXY($xPos + $cellWidth , $yPos);

		$cellWidth=30; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth('WAKTU PENYELESAIAN') < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen('WAKTU PENYELESAIAN');	//total panjang teks
			$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr('WAKTU PENYELESAIAN',$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,'WAKTU PENYELESAIAN',1,'C');
		$pdf->SetXY($xPos + $cellWidth , $yPos);

		$cellWidth=20; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth('WAKTU EFEKTIF') < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen('WAKTU EFEKTIF');	//total panjang teks
			$errMargin=5;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr('WAKTU EFEKTIF',$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,'WAKTU EFEKTIF',1,'C');
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->MultiCell(25,$cellHeight,'KEBUTUHAN PEGAWAI',1,1,'C');


        $query5 = Tugas_pokok::where('id_jabatan_sopd', $id)->orderBy('id', 'asc');
		$jml_waktu_penyelesaian = 0;
		$jml_kebutuhan_pegawai = 0;
		if ($query5->count() > 0) {
			$no = 0;
			foreach ($query5->get() as $itemQuery5) {
				$cellWidth=70; //lebar sel
				$cellHeight=5; //tinggi sel satu baris normal

				//periksa apakah teksnya melibihi kolom?
				if($pdf->GetStringWidth($itemQuery5->uraian_tugas) < $cellWidth){
					//jika tidak, maka tidak melakukan apa-apa
					$line=1;
				}else{
					//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
					//dengan memisahkan teks agar sesuai dengan lebar sel
					//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

					$textLength=strlen($itemQuery5->uraian_tugas);	//total panjang teks
					$errMargin=15;		//margin kesalahan lebar sel, untuk jaga-jaga
					$startChar=0;		//posisi awal karakter untuk setiap baris
					$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
					$textArray=array();	//untuk menampung data untuk setiap baris
					$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

					while($startChar < $textLength){ //perulangan sampai akhir teks
						//perulangan sampai karakter maksimum tercapai
						while(
						$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
						($startChar+$maxChar) < $textLength ) {
							$maxChar++;
							$tmpString=substr($itemQuery5->uraian_tugas,$startChar,$maxChar);
						}
						//pindahkan ke baris berikutnya
						$startChar=$startChar+$maxChar;
						//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
						array_push($textArray,$tmpString);
						//reset variabel penampung
						$maxChar=0;
						$tmpString='';

					}
					//dapatkan jumlah baris
					$line=count($textArray);
				}

			    //tulis selnya
			  $pdf->SetFillColor(255,255,255);
				$pdf->Cell(10,($line * $cellHeight),++$no,1,0,'C',true); //sesuaikan ketinggian dengan jumlah garis
				// $pdf->Cell(4,($line * $cellHeight),$hasil['tanggal'],1,0); //sesuaikan ketinggian dengan jumlah garis

				//memanfaatkan MultiCell sebagai ganti Cell
				//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
				//ingat posisi x dan y sebelum menulis MultiCell
				$xPos=$pdf->GetX();
				$yPos=$pdf->GetY();
				$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery5->uraian_tugas,1);

				//kembalikan posisi untuk sel berikutnya di samping MultiCell
			    //dan offset x dengan lebar MultiCell
				$pdf->SetXY($xPos + $cellWidth , $yPos);

			  $pdf->Cell(23,($line * $cellHeight),$itemQuery5->hasil_kerja,1,0,'C');
				$pdf->Cell(20,($line * $cellHeight),$itemQuery5->jumlah_hasil,1,0,'C');
				$pdf->Cell(30,($line * $cellHeight),$itemQuery5->waktu_penyelesaian_jam,1,0,'C');
				$pdf->Cell(20,($line * $cellHeight),$itemQuery5->waktu_efektif,1,0,'C');
				$pdf->Cell(25,($line * $cellHeight),round($itemQuery5->kebutuhan_pegawai,4),1,1,'C');
				if ($itemQuery5->waktu_penyelesaian_jam != '') {
				    if (is_numeric($itemQuery5->waktu_penyelesaian_jam)) {
				        $key_waktu_penyelesaian_jam = $itemQuery5->waktu_penyelesaian_jam;
				    }  else {
    				    $key_waktu_penyelesaian_jam = 0;
    				}
				} else {
				    $key_waktu_penyelesaian_jam = 0;
				}
				if ($itemQuery5->kebutuhan_pegawai != '') {
				    if (is_numeric($itemQuery5->kebutuhan_pegawai)) {
				        $key_kebutuhan_pegawai = $itemQuery5->kebutuhan_pegawai;
				    }  else {
    				    $key_kebutuhan_pegawai = 0;
    				}
				} else {
				    $key_kebutuhan_pegawai = 0;
				}
				$jml_waktu_penyelesaian = $jml_waktu_penyelesaian + $key_waktu_penyelesaian_jam;
				$jml_kebutuhan_pegawai = $jml_kebutuhan_pegawai + $key_kebutuhan_pegawai;
			}
			$pdf->Cell(123,6,'JUMLAH',1,0,'C');
			$pdf->Cell(30,6,$jml_waktu_penyelesaian,1,0,'C');
			$pdf->Cell(20,6,"",1,0,'C');
			$pdf->Cell(25,6,round($jml_kebutuhan_pegawai,4),1,1,'C');
			$pdf->Cell(123,6,'JUMLAH PEGAWAI',1,0,'C');
			$pdf->Cell(50,6,"",1,0,'C');
			$pdf->Cell(25,6,round($jml_kebutuhan_pegawai),1,1,'C');
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(70,6,"",1,0,'C');
			$pdf->Cell(23,6,"",1,0,'C');
			$pdf->Cell(20,6,"",1,0,'C');
			$pdf->Cell(30,6,"",1,0,'C');
			$pdf->Cell(20,6,"",1,0,'C');
			$pdf->Cell(25,6,"",1,1,'C');
			$pdf->Cell(123,6,'JUMLAH',1,0,'C');
			$pdf->Cell(30,6,'......',1,0,'C');
			$pdf->Cell(20,6,"",1,0,'C');
			$pdf->Cell(25,6,'......',1,1,'C');
			$pdf->Cell(123,6,'JUMLAH PEGAWAI',1,0,'C');
			$pdf->Cell(50,6,"",1,0,'C');
			$pdf->Cell(25,6,'......',1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'7. HASIL KERJA',0,0,'');

        $query6 = Hasil_kerja::where('id_jabatan_sopd', $id);
		if ($query6->count() > 0) {
			$no = 0;
			foreach ($query6->get() as $itemQuery6) {
				if ($no != 0) {
					$pdf->Cell(50,6,'',0,0,'');
				}
				$pdf->Cell(5,6,': ',0,0,'');
				$pdf->Cell(80,6,$itemQuery6->hasil,0,1,'');
				$no++;
			}
		} else {
			$pdf->Cell(80,6,"",0,1,'');
		}

		$pdf->Cell(50,6,'8. BAHAN KERJA',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(90,6,'BAHAN KERJA',1,0,'C');
		$pdf->Cell(98,6,'PENGGUNAAN DALAM TUGAS',1,1,'C');

        $query7 = Bahan_kerja::where('id_jabatan_sopd', $id);

		if ($query7->count() > 0) {
			$no = 0;
			foreach ($query7->get() as $itemQuery7) {
				$pdf->Cell(10,6,++$no,1,0,'C');
				$pdf->Cell(90,6,$itemQuery7->bahan_kerja,1,0,'');
				$pdf->Cell(98,6,$itemQuery7->penggunaan_dalam_tugas,1,1,'');
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(90,6,"",1,0,'C');
			$pdf->Cell(98,6,"",1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'9. PERANGKAT KERJA',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(90,6,'PERANGKAT KERJA',1,0,'C');
		$pdf->Cell(98,6,'PENGGUNAAN UNTUK TUGAS',1,1,'C');

        $query8 = Perangkat_kerja::where('id_jabatan_sopd', $id);
		if ($query8->count() > 0) {
			$no = 0;
			foreach ($query8->get() as $itemQuery8) {
				$pdf->Cell(10,6,++$no,1,0,'C');
				$pdf->Cell(90,6,$itemQuery8->perangkat_kerja,1,0,'');
				$pdf->Cell(98,6,$itemQuery8->penggunaan_untuk_tugas,1,1,'');
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(90,6,"",1,0,'C');
			$pdf->Cell(98,6,"",1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'10. TANGGUN JAWAB',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(188,6,'URAIAN',1,1,'C');

        $query9 = Tanggung_jawab::where('id_jabatan_sopd', $id);
		if ($query9->count() > 0) {
			$no = 0;
			foreach ($query9->get() as $itemQuery9) {
				$pdf->Cell(10,6,++$no,1,0,'C');
				$pdf->Cell(188,6,$itemQuery9->uraian,1,1,'');
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(188,6,"",1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'11. WEWENANG',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(188,6,'URAIAN',1,1,'C');

        $query10 = Wewenang::where('id_jabatan_sopd', $id);
		if ($query10->count() > 0) {
			$no = 0;
			foreach ($query10->get() as $itemQuery10) {
				$pdf->Cell(10,6,++$no,1,0,'C');
				$pdf->Cell(188,6,$itemQuery10->uraian,1,1,'');
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(188,6,"",1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'12. KORELASI JABATAN',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(64,6,'NAMA JABATAN',1,0,'C');
		$pdf->Cell(60,6,'UNIT KERJA / INSTANSI',1,0,'C');
		$pdf->Cell(64,6,'DALAM HAL',1,1,'C');

        $query11 = Korelasi_jabatan::where('id_jabatan_sopd', $id);
		if ($query11->count() > 0) {
			$no = 0;
			foreach ($query11->get() as $itemQuery11) {
				// $pdf->Cell(64,6,$key->nm_jabatan,1,0,'');
				$cellWidth=64; //lebar sel
				$cellHeight=5; //tinggi sel satu baris normal

				//periksa apakah teksnya melibihi kolom?
				if($pdf->GetStringWidth($itemQuery11->nm_jabatan) < $cellWidth &&
				$pdf->GetStringWidth($itemQuery11->dalam_hal) < $cellWidth &&
				$pdf->GetStringWidth($itemQuery11->unit_kerja_instansi) < 60) {
					//jika tidak, maka tidak melakukan apa-apa
					$line=1;
				}else{
					if ($pdf->GetStringWidth($itemQuery11->nm_jabatan) > $pdf->GetStringWidth($itemQuery11->dalam_hal)) {
						$val = $itemQuery11->nm_jabatan;
					} else {
						$val = $itemQuery11->dalam_hal;
					}
					if ($pdf->GetStringWidth($itemQuery11->nm_jabatan) < $cellWidth &&
					$pdf->GetStringWidth($itemQuery11->dalam_hal) < $cellWidth &&
					$pdf->GetStringWidth($itemQuery11->unit_kerja_instansi) > 60) {
						$val = $itemQuery11->unit_kerja_instansi;
					}
					if ($pdf->GetStringWidth($itemQuery11->unit_kerja_instansi) > $pdf->GetStringWidth($itemQuery11->nm_jabatan)) {
					    $val = $itemQuery11->unit_kerja_instansi;
					}

					$textLength=strlen($val);	//total panjang teks
					$errMargin=10;		//margin kesalahan lebar sel, untuk jaga-jaga
					$startChar=0;		//posisi awal karakter untuk setiap baris
					$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
					$textArray=array();	//untuk menampung data untuk setiap baris
					$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

					while($startChar < $textLength){ //perulangan sampai akhir teks
						//perulangan sampai karakter maksimum tercapai
						while(
						$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
						($startChar+$maxChar) < $textLength ) {
							$maxChar++;
							$tmpString=substr($val,$startChar,$maxChar);
						}
						//pindahkan ke baris berikutnya
						$startChar=$startChar+$maxChar;
						//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
						array_push($textArray,$tmpString);
						//reset variabel penampung
						$maxChar=0;
						$tmpString='';

					}
					//dapatkan jumlah baris
					$line=count($textArray);
				}

					//tulis selnya
				$pdf->SetFillColor(255,255,255);
				$pdf->Cell(10,($line * $cellHeight),++$no,1,0,'C',true);
				//memanfaatkan MultiCell sebagai ganti Cell
				//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
				//ingat posisi x dan y sebelum menulis MultiCell
				$xPos=$pdf->GetX();
				$yPos=$pdf->GetY();
				if($pdf->GetStringWidth($itemQuery11->nm_jabatan) > $cellWidth &&
					$pdf->GetStringWidth($itemQuery11->dalam_hal) > $cellWidth) {
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery11->nm_jabatan,1);
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(60,($line * $cellHeight),$itemQuery11->unit_kerja_instansi,1,0,'');
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery11->dalam_hal,1);
				} elseif($pdf->GetStringWidth($itemQuery11->nm_jabatan) > $cellWidth &&
					$pdf->GetStringWidth($itemQuery11->unit_kerja_instansi) > 60) {
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery11->nm_jabatan,1);
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->MultiCell(60,$cellHeight,$itemQuery11->unit_kerja_instansi,1);
					$pdf->SetXY($xPos + 124 , $yPos);
					$pdf->Cell(64,($line * $cellHeight),$itemQuery11->dalam_hal,1,1,'');
				} elseif ($pdf->GetStringWidth($itemQuery11->nm_jabatan) > $cellWidth) {
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery11->nm_jabatan,1);
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(60,($line * $cellHeight),$itemQuery11->unit_kerja_instansi,1,0,'');
					$pdf->Cell(64,($line * $cellHeight),$itemQuery11->dalam_hal,1,1,'');
				} elseif ($pdf->GetStringWidth($itemQuery11->unit_kerja_instansi) > 60) {
					$pdf->Cell(64,($line * $cellHeight),$itemQuery11->nm_jabatan,1,0,'');
					$pdf->MultiCell(60,$cellHeight,$itemQuery11->unit_kerja_instansi,1);
					$pdf->SetXY($xPos + 124 , $yPos);
					$pdf->Cell(64,($line * $cellHeight),$itemQuery11->dalam_hal,1,1,'');
				} else {
					$pdf->Cell(64,($line * $cellHeight),$itemQuery11->nm_jabatan,1,0,'');
					$pdf->Cell(60,($line * $cellHeight),$itemQuery11->unit_kerja_instansi,1,0,'');
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery11->dalam_hal,1);
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(5,($line * $cellHeight),'',0,1,'');
				}
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(64,6,"",1,0,'C');
			$pdf->Cell(60,6,"",1,0,'C');
			$pdf->Cell(64,6,"",1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'13. KONDISI LINGKUNGAN KERJA',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(90,6,'ASPEK',1,0,'C');
		$pdf->Cell(98,6,'FAKTOR',1,1,'C');

        $query12 = Kondisi_lingkungan_kerja::where('id_jabatan_sopd', $id);

		if ($query12->count() > 0) {
			$no = 0;
			foreach ($query12->get() as $itemQuery12) {
				$pdf->Cell(10,6,++$no,1,0,'C');
				$pdf->Cell(90,6,$itemQuery12->aspek,1,0,'');
				$pdf->Cell(98,6,$itemQuery12->faktor,1,1,'');
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(90,6,"",1,0,'C');
			$pdf->Cell(98,6,"",1,1,'C');
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'14. RISIKO BAHAYA',0,1,'');
		$pdf->Cell(10,6,'NO',1,0,'C');
		$pdf->Cell(90,6,'NAMA RESIKO',1,0,'C');
		$pdf->Cell(98,6,'PENYEBAB',1,1,'C');

        $query13 = Resiko_bahaya::where('id_jabatan_sopd', $id);
		if ($query13->count() > 0) {
			$no = 0;
			foreach ($query13->get() as $itemQuery13) {
				$pdf->Cell(10,6,++$no,1,0,'C');
				$pdf->Cell(90,6,$itemQuery13->nama_resiko,1,0,'');
				$pdf->Cell(98,6,$itemQuery13->penyebab,1,1,'');
			}
		} else {
			$pdf->Cell(10,6,"1",1,0,'C');
			$pdf->Cell(90,6,"",1,0,'C');
			$pdf->Cell(98,6,"",1,1,'C');
		}

		// $this->db->where('id_jabatan_sopd', $id);
		// $query = $this->db->get('syarat_jabatans');

        $query14 = Syarat_jabatan::where('id_jabatan_sopd', $id);
		if ($query14->count() > 0) {
			foreach ($query14->get() as $itemQuery14) {
				$keterampilan_kerja = $itemQuery14->keterampilan_kerja;
				$bakat_kerja = $itemQuery14->bakat_kerja;
				$temperamen_kerja = $itemQuery14->temperamen_kerja;
				$minat_kerja = $itemQuery14->minat_kerja;
				$upaya_fisik = $itemQuery14->upaya_fisik;
				$jenis_kelamin = $itemQuery14->jenis_kelamin;
				$umur = $itemQuery14->umur;
				$tinggi_badan = $itemQuery14->tinggi_badan;
				$berat_badan = $itemQuery14->berat_badan;
				$postur_badan = $itemQuery14->postur_badan;
				$penampilan = $itemQuery14->penampilan;
				$fungsi_pekerjaan = $itemQuery14->fungsi_pekerjaan;
			}
		} else {
			$keterampilan_kerja = "";
			$bakat_kerja = "";
			$temperamen_kerja = "";
			$minat_kerja = "";
			$upaya_fisik = "";
			$jenis_kelamin = "";
			$umur = "";
			$tinggi_badan = "";
			$berat_badan = "";
			$postur_badan = "";
			$penampilan = "";
			$fungsi_pekerjaan = "";
		}

		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(50,6,'15. SYARAT JABATAN',0,1,'');
		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'a. Keterampilan Kerja',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');

		$cellWidth=148; //lebar sel
		$cellHeight=5; //tinggi sel satu baris normal

		//periksa apakah teksnya melibihi kolom?
		if($pdf->GetStringWidth($keterampilan_kerja) < $cellWidth){
			//jika tidak, maka tidak melakukan apa-apa
			$line=1;
		}else{
			//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
			//dengan memisahkan teks agar sesuai dengan lebar sel
			//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

			$textLength=strlen($keterampilan_kerja);	//total panjang teks
			$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
			$startChar=0;		//posisi awal karakter untuk setiap baris
			$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
			$textArray=array();	//untuk menampung data untuk setiap baris
			$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

			while($startChar < $textLength){ //perulangan sampai akhir teks
				//perulangan sampai karakter maksimum tercapai
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($keterampilan_kerja,$startChar,$maxChar);
				}
				//pindahkan ke baris berikutnya
				$startChar=$startChar+$maxChar;
				//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
				array_push($textArray,$tmpString);
				//reset variabel penampung
				$maxChar=0;
				$tmpString='';

			}
			//dapatkan jumlah baris
			$line=count($textArray);
		}

			//tulis selnya
		$pdf->SetFillColor(255,255,255);
		//memanfaatkan MultiCell sebagai ganti Cell
		//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
		//ingat posisi x dan y sebelum menulis MultiCell
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$keterampilan_kerja,0);

		//kembalikan posisi untuk sel berikutnya di samping MultiCell
		//dan offset x dengan lebar MultiCell
		$pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(50,($line * $cellHeight),'',0,1,'');

        // bakat kerja
		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'b. Bakat Kerja',0,0,'');
		$bkt = explode(' - ',$bakat_kerja);
		for ($i=0; $i < count($bkt); $i++) {
			if ($i != 0) {
				$pdf->Cell(44,6,'',0,0,'');
			}
			$pdf->Cell(5,6,': ',0,0,'');
			$pdf->Cell(80,6,$bkt[$i],0,0,'');

            $query15 = s_bakat_kerja::where('value', $bkt[$i]);
			if ($query15->count() > 0) {
				foreach ($query15->get() as $itemQuery15) {
					$cellWidth=68; //lebar sel
					$cellHeight=5; //tinggi sel satu baris normal

					//periksa apakah teksnya melibihi kolom?
					if($pdf->GetStringWidth($itemQuery15->ket) < $cellWidth){
						//jika tidak, maka tidak melakukan apa-apa
						$line=1;
					}else{
						//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
						//dengan memisahkan teks agar sesuai dengan lebar sel
						//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

						$textLength=strlen($itemQuery15->ket);	//total panjang teks
						$errMargin=10;		//margin kesalahan lebar sel, untuk jaga-jaga
						$startChar=0;		//posisi awal karakter untuk setiap baris
						$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
						$textArray=array();	//untuk menampung data untuk setiap baris
						$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

						while($startChar < $textLength){ //perulangan sampai akhir teks
							//perulangan sampai karakter maksimum tercapai
							while(
							$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
							($startChar+$maxChar) < $textLength ) {
								$maxChar++;
								$tmpString=substr($itemQuery15->ket,$startChar,$maxChar);
							}
							//pindahkan ke baris berikutnya
							$startChar=$startChar+$maxChar;
							//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
							array_push($textArray,$tmpString);
							//reset variabel penampung
							$maxChar=0;
							$tmpString='';

						}
						//dapatkan jumlah baris
						$line=count($textArray);
					}

						//tulis selnya
					$pdf->SetFillColor(255,255,255);
					//memanfaatkan MultiCell sebagai ganti Cell
					//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
					//ingat posisi x dan y sebelum menulis MultiCell
					$xPos=$pdf->GetX();
					$yPos=$pdf->GetY();
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery15->ket,0);

					//kembalikan posisi untuk sel berikutnya di samping MultiCell
						//dan offset x dengan lebar MultiCell
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(50,($line * $cellHeight),'',0,1,'');
				}
			} else {
				$pdf->Cell(80,6,'',0,1,'');
			}
		}

        // temperamen kerja
		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'c. Temperamen Kerja',0,0,'');
		$tmp = explode(' - ',$temperamen_kerja);
		for ($i=0; $i < count($tmp); $i++) {
			if ($i != 0) {
				$pdf->Cell(44,6,'',0,0,'');
			}
			$pdf->Cell(5,6,': ',0,0,'');
			$pdf->Cell(80,6,$tmp[$i],0,0,'');

            $query16 = s_temperamen_kerja::where('value', $tmp[$i]);
			if ($query16->count() > 0) {
				foreach ($query16->get() as $itemQuery16) {
					$cellWidth=68; //lebar sel
					$cellHeight=5; //tinggi sel satu baris normal

					//periksa apakah teksnya melibihi kolom?
					if($pdf->GetStringWidth($itemQuery16->ket) < $cellWidth){
						//jika tidak, maka tidak melakukan apa-apa
						$line=1;
					}else{
						//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
						//dengan memisahkan teks agar sesuai dengan lebar sel
						//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

						$textLength=strlen($itemQuery16->ket);	//total panjang teks
						$errMargin=9;		//margin kesalahan lebar sel, untuk jaga-jaga
						$startChar=0;		//posisi awal karakter untuk setiap baris
						$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
						$textArray=array();	//untuk menampung data untuk setiap baris
						$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

						while($startChar < $textLength){ //perulangan sampai akhir teks
							//perulangan sampai karakter maksimum tercapai
							while(
							$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
							($startChar+$maxChar) < $textLength ) {
								$maxChar++;
								$tmpString=substr($itemQuery16->ket,$startChar,$maxChar);
							}
							//pindahkan ke baris berikutnya
							$startChar=$startChar+$maxChar;
							//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
							array_push($textArray,$tmpString);
							//reset variabel penampung
							$maxChar=0;
							$tmpString='';

						}
						//dapatkan jumlah baris
						$line=count($textArray);
					}

						//tulis selnya
					$pdf->SetFillColor(255,255,255);
					//memanfaatkan MultiCell sebagai ganti Cell
					//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
					//ingat posisi x dan y sebelum menulis MultiCell
					$xPos=$pdf->GetX();
					$yPos=$pdf->GetY();
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery16->ket,0);

					//kembalikan posisi untuk sel berikutnya di samping MultiCell
						//dan offset x dengan lebar MultiCell
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(50,($line * $cellHeight),'',0,1,'');
				}
			} else {
				$pdf->Cell(80,6,'',0,1,'');
			}
		}

        // minat kerja
		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'d. Minat Kerja',0,0,'');
		$mnt = explode(' - ',$minat_kerja);
		for ($i=0; $i < count($mnt); $i++) {
			if ($i != 0) {
				$pdf->Cell(44,6,'',0,0,'');
			}
			$pdf->Cell(5,6,': ',0,0,'');
			$pdf->Cell(80,6,$mnt[$i],0,0,'');

            $query17 = s_minat_kerja::where('value', $mnt[$i]);
			if ($query17->count() > 0) {
				foreach ($query17->get() as $itemQuery17) {
					$cellWidth=68; //lebar sel
					$cellHeight=5; //tinggi sel satu baris normal

					//periksa apakah teksnya melibihi kolom?
					if($pdf->GetStringWidth($itemQuery17->ket) < $cellWidth){
						//jika tidak, maka tidak melakukan apa-apa
						$line=1;
					}else{
						//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
						//dengan memisahkan teks agar sesuai dengan lebar sel
						//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

						$textLength=strlen($itemQuery17->ket);	//total panjang teks
						$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
						$startChar=0;		//posisi awal karakter untuk setiap baris
						$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
						$textArray=array();	//untuk menampung data untuk setiap baris
						$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

						while($startChar < $textLength){ //perulangan sampai akhir teks
							//perulangan sampai karakter maksimum tercapai
							while(
							$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
							($startChar+$maxChar) < $textLength ) {
								$maxChar++;
								$tmpString=substr($itemQuery17->ket,$startChar,$maxChar);
							}
							//pindahkan ke baris berikutnya
							$startChar=$startChar+$maxChar;
							//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
							array_push($textArray,$tmpString);
							//reset variabel penampung
							$maxChar=0;
							$tmpString='';

						}
						//dapatkan jumlah baris
						$line=count($textArray);
					}

						//tulis selnya
					$pdf->SetFillColor(255,255,255);
					//memanfaatkan MultiCell sebagai ganti Cell
					//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
					//ingat posisi x dan y sebelum menulis MultiCell
					$xPos=$pdf->GetX();
					$yPos=$pdf->GetY();
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery17->ket,0);

					//kembalikan posisi untuk sel berikutnya di samping MultiCell
						//dan offset x dengan lebar MultiCell
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(50,($line * $cellHeight),'',0,1,'');
				}
			} else {
				$pdf->Cell(80,6,'',0,1,'');
			}
		}

        // upaya fisik
		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'e. Upaya Fisik',0,0,'');
		$upy = explode(' - ',$upaya_fisik);
		for ($i=0; $i < count($upy); $i++) {
			if ($i != 0) {
				$pdf->Cell(44,6,'',0,0,'');
			}
			$pdf->Cell(5,6,': ',0,0,'');
			$pdf->Cell(80,6,$upy[$i],0,0,'');

            $query18 = s_upaya_fisik::where('value', $upy[$i]);

			if ($query18->count() > 0) {
				foreach ($query18->get() as $itemQuery18) {
					$cellWidth=68; //lebar sel
					$cellHeight=5; //tinggi sel satu baris normal

					//periksa apakah teksnya melibihi kolom?
					if($pdf->GetStringWidth($itemQuery18->ket) < $cellWidth){
						//jika tidak, maka tidak melakukan apa-apa
						$line=1;
					}else{
						//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
						//dengan memisahkan teks agar sesuai dengan lebar sel
						//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

						$textLength=strlen($itemQuery18->ket);	//total panjang teks
						$errMargin=10;		//margin kesalahan lebar sel, untuk jaga-jaga
						$startChar=0;		//posisi awal karakter untuk setiap baris
						$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
						$textArray=array();	//untuk menampung data untuk setiap baris
						$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

						while($startChar < $textLength){ //perulangan sampai akhir teks
							//perulangan sampai karakter maksimum tercapai
							while(
							$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
							($startChar+$maxChar) < $textLength ) {
								$maxChar++;
								$tmpString=substr($itemQuery18->ket,$startChar,$maxChar);
							}
							//pindahkan ke baris berikutnya
							$startChar=$startChar+$maxChar;
							//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
							array_push($textArray,$tmpString);
							//reset variabel penampung
							$maxChar=0;
							$tmpString='';

						}
						//dapatkan jumlah baris
						$line=count($textArray);
					}

						//tulis selnya
					$pdf->SetFillColor(255,255,255);
					//memanfaatkan MultiCell sebagai ganti Cell
					//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
					//ingat posisi x dan y sebelum menulis MultiCell
					$xPos=$pdf->GetX();
					$yPos=$pdf->GetY();
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery18->ket,0);

					//kembalikan posisi untuk sel berikutnya di samping MultiCell
						//dan offset x dengan lebar MultiCell
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(50,($line * $cellHeight),'',0,1,'');
				}
			} else {
				$pdf->Cell(80,6,'',0,1,'');
			}
		}

		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'f. Kondisi Fisik',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,"",0,1,'');
		$pdf->Cell(49,6,'',0,0,'');
		$pdf->Cell(40,6,"1) Jenis Kelamin",0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$jenis_kelamin,0,1,'');
		$pdf->Cell(49,6,'',0,0,'');
		$pdf->Cell(40,6,"2) Umur",0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$umur,0,1,'');
		$pdf->Cell(49,6,'',0,0,'');
		$pdf->Cell(40,6,"3) Tinggi badan",0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$tinggi_badan,0,1,'');
		$pdf->Cell(49,6,'',0,0,'');
		$pdf->Cell(40,6,"4) Berat badan",0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$berat_badan,0,1,'');
		$pdf->Cell(49,6,'',0,0,'');
		$pdf->Cell(40,6,"5) Postur badan",0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$postur_badan,0,1,'');
		$pdf->Cell(49,6,'',0,0,'');
		$pdf->Cell(40,6,"6) Penampilan",0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$penampilan,0,1,'');

		$pdf->Cell(4,6,'',0,0,'');
		$pdf->Cell(40,6,'g. Fungsi Pekerjaan',0,0,'');
		$fng = explode(' - ',$fungsi_pekerjaan);
		for ($i=0; $i < count($fng); $i++) {
			if ($i != 0) {
				$pdf->Cell(44,6,'',0,0,'');
			}
			$pdf->Cell(5,6,': ',0,0,'');
			$pdf->Cell(80,6,$fng[$i],0,0,'');

            $query19 = s_fungsi_pekerjaan::where('value', $fng[$i]);
			if ($query19->count() > 0) {
				foreach ($query19->get() as $itemQuery19) {
					$cellWidth=68; //lebar sel
					$cellHeight=5; //tinggi sel satu baris normal

					//periksa apakah teksnya melibihi kolom?
					if($pdf->GetStringWidth($itemQuery19->ket) < $cellWidth){
						//jika tidak, maka tidak melakukan apa-apa
						$line=1;
					}else{
						//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
						//dengan memisahkan teks agar sesuai dengan lebar sel
						//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

						$textLength=strlen($itemQuery19->ket);	//total panjang teks
						$errMargin=8;		//margin kesalahan lebar sel, untuk jaga-jaga
						$startChar=0;		//posisi awal karakter untuk setiap baris
						$maxChar=0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
						$textArray=array();	//untuk menampung data untuk setiap baris
						$tmpString="";		//untuk menampung teks untuk setiap baris (sementara)

						while($startChar < $textLength){ //perulangan sampai akhir teks
							//perulangan sampai karakter maksimum tercapai
							while(
							$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
							($startChar+$maxChar) < $textLength ) {
								$maxChar++;
								$tmpString=substr($itemQuery19->ket,$startChar,$maxChar);
							}
							//pindahkan ke baris berikutnya
							$startChar=$startChar+$maxChar;
							//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
							array_push($textArray,$tmpString);
							//reset variabel penampung
							$maxChar=0;
							$tmpString='';

						}
						//dapatkan jumlah baris
						$line=count($textArray);
					}

						//tulis selnya
					$pdf->SetFillColor(255,255,255);
					//memanfaatkan MultiCell sebagai ganti Cell
					//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
					//ingat posisi x dan y sebelum menulis MultiCell
					$xPos=$pdf->GetX();
					$yPos=$pdf->GetY();
					$pdf->MultiCell($cellWidth,$cellHeight,$itemQuery19->ket,0);

					//kembalikan posisi untuk sel berikutnya di samping MultiCell
						//dan offset x dengan lebar MultiCell
					$pdf->SetXY($xPos + $cellWidth , $yPos);
					$pdf->Cell(50,($line * $cellHeight),'',0,1,'');
				}
			} else {
				$pdf->Cell(80,6,'',0,1,'');
			}
		}

        $query20 = prestasi_kerja_yang_diharapkan::where('id_jabatan_sopd', $id);
		if ($query20->count() > 0) {
			foreach ($query20->get() as $itemQuery20) {
				$prestasi = $itemQuery20->prestasi;
			}
		} else {
			$prestasi = "";
		}
		$pdf->Cell(40,4,"",0,1,'C');
		$pdf->Cell(75,6,'16. PRESTASI KERJA YANG DIHARAPKAN',0,0,'');
		$pdf->Cell(4,6,': ',0,0,'');

		$cellWidth=115;
		$cellHeight=5;

		if($pdf->GetStringWidth($prestasi) < $cellWidth){
			$line=1;
		}else{
			$textLength=strlen($prestasi);
			$errMargin=8;
			$startChar=0;
			$maxChar=0;
			$textArray=array();
			$tmpString="";

			while($startChar < $textLength){
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString=substr($prestasi,$startChar,$maxChar);
				}
				$startChar=$startChar+$maxChar;
				array_push($textArray,$tmpString);
				$maxChar=0;
				$tmpString='';

			}
			$line=count($textArray);
		}

		$pdf->SetFillColor(255,255,255);
		$xPos=$pdf->GetX();
		$yPos=$pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$prestasi,0);

        $pdf->SetXY($xPos + $cellWidth , $yPos);
		$pdf->Cell(50,($line * $cellHeight),'',0,1,'');

		$pdf->Cell(75,6,'17. KELAS JABATAN',0,0,'');
		$pdf->Cell(5,6,': ',0,0,'');
		$pdf->Cell(80,6,$kelas,0,1,'');

		$pdf->Output();
        exit;
    }

}
