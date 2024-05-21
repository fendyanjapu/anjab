<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\menuSatuController;
use App\Http\Controllers\menuDuaController;
use App\Http\Controllers\menuTigaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route Login & logout
Route::get('/', [homeController::class,'index'])->name('home');
Route::get('/login', [homeController::class,'login'])->name('login');
Route::post('/login_aksi', [homeController::class,'login_aksi'])->name('login_aksi');
Route::get('logout', [homeController::class,'logout'])->name('logout');

// Route Select & Search Filter
Route::post('/jabatan', [homeController::class,'jabatan'])->name('jabatan');
Route::post('/cari', [homeController::class,'cari']);

// Route Middleware login
Route::group(['middleware' => 'ceklog'], function () {
    Route::get('/admin', [adminController::class,'index'])->name('admin');
});

// Route Menu Jabatan
Route::get('admin/jabatan_sopd', [menuSatuController::class, 'indexJabatan'])->name('jabatan.index');
Route::get('admin/jabatan_sopd/add', [menuSatuController::class, 'addJabatan'])->name('jabatan.add');
Route::post('admin/jabatan_sopd/save', [menuSatuController::class, 'saveJabatan'])->name('jabatan.save');
Route::get('admin/jabatan_sopd/{id}/edit', [menuSatuController::class, 'editJabatan'])->name('jabatan.edit');
Route::put('admin/jabatan_sopd/{id}/update', [menuSatuController::class, 'updateJabatan'])->name('jabatan.update');
Route::delete('admin/jabatan_sopd/{id}/hapus', [menuSatuController::class, 'hapusJabatan'])->name('jabatan.hapus');

// Route Menu Ikhtiar Jabatan
Route::get('admin/iktisar', [menuSatuController::class, 'indexIktisar'])->name('iktisar.index');
Route::get('admin/iktisar/add', [menuSatuController::class, 'addIktisar'])->name('iktisar.add');
Route::post('admin/iktisar/save', [menuSatuController::class, 'saveIktisar'])->name('iktisar.save');
Route::get('admin/iktisar/{id}/edit', [menuSatuController::class, 'editIktisar'])->name('iktisar.edit');
Route::put('admin/iktisar/{id}/update', [menuSatuController::class, 'updateIktisar'])->name('iktisar.update');
Route::get('admin/iktisar/{id}/hapus', [menuSatuController::class, 'hapusIktisar'])->name('iktisar.hapus');

// Route Menu Kualifikasi Jabatan
Route::get('admin/kualifikasi-jabatan', [menuSatuController::class, 'indexKualifikasi'])->name('kualifikasi.index');
Route::get('admin/kualifikasi-jabatan/add', [menuSatuController::class, 'addKualifikasi'])->name('kualifikasi.add');
Route::post('admin/kualifikasi-jabatan/save', [menuSatuController::class, 'saveKualifikasi'])->name('kualifikasi.save');
Route::get('admin/kualifikasi-jabatan/{id}/edit', [menuSatuController::class, 'editKualifikasi'])->name('kualifikasi.edit');
Route::put('admin/kualifikasi-jabatan/{id}/update', [menuSatuController::class, 'updateKualifikasi'])->name('kualifikasi.update');
Route::get('admin/kualifikasi-jabatan/{id}/hapus', [menuSatuController::class, 'hapusKualifikasi'])->name('kualifikasi.hapus');

// Route Menu Tugas Pokok
Route::get('admin/tugas-pokok', [menuSatuController::class, 'indexTugasPokok'])->name('tugasPokok.index');
Route::get('admin/tugas-pokok/add', [menuSatuController::class, 'addTugasPokok'])->name('tugasPokok.add');
Route::post('admin/tugas-pokok/save', [menuSatuController::class, 'saveTugasPokok'])->name('tugasPokok.save');
Route::get('admin/tugas-pokok/{id}/edit', [menuSatuController::class, 'editTugasPokok'])->name('tugasPokok.edit');
Route::put('admin/tugas-pokok/{id}/update', [menuSatuController::class, 'updateTugasPokok'])->name('tugasPokok.update');
Route::get('admin/tugas-pokok/{id}/hapus', [menuSatuController::class, 'hapusTugasPokok'])->name('tugasPokok.hapus');
Route::get('admin/tugas-pokok/Excel', [menuSatuController::class, 'TugasPokokExcel'])->name('tugasPokok.excel');
Route::get('admin/tugas-pokok/download', [menuSatuController::class, 'TugasPokokDownload'])->name('tugasPokok.download');
Route::get('admin/tugas-pokok/save-excel', [menuSatuController::class, 'TugasPokokSaveExcel'])->name('tugasPokok.saveExcel');

// Route Menu Hasil Kerja
Route::get('admin/hasil-kerja', [menuDuaController::class, 'indexHasilKerja'])->name('hasilKerja.index');
Route::post('admin/hasil-kerja/jumlah_kolom', [menuDuaController::class, 'jml_kolom'])->name('hasilKerja.jml_kolom');
Route::get('admin/hasil-kerja/add', [menuDuaController::class, 'addHasilKerja'])->name('hasilKerja.add');
Route::post('admin/hasil-kerja/save', [menuDuaController::class, 'saveHasilKerja'])->name('hasilKerja.save');
Route::get('admin/hasil-kerja/{id}/edit', [menuDuaController::class, 'editHasilKerja'])->name('hasilKerja.edit');
Route::put('admin/hasil-kerja/{id}/update', [menuDuaController::class, 'updateHasilKerja'])->name('hasilKerja.update');
Route::get('admin/hasil-kerja/{id}/hapus', [menuDuaController::class, 'hapusHasilKerja'])->name('hasilKerja.hapus');

// Route Menu Bahan Kerja
Route::get('admin/bahan-kerja', [menuDuaController::class, 'indexBahanKerja'])->name('bahanKerja.index');
Route::post('admin/bahan-kerja/jumlah_kolom', [menuDuaController::class, 'jml_kolom_bahan_kerja'])->name('bahanKerja.jml_kolom');
Route::get('admin/bahan-kerja/add', [menuDuaController::class, 'addBahanKerja'])->name('bahanKerja.add');
Route::post('admin/bahan-kerja/save', [menuDuaController::class, 'saveBahanKerja'])->name('bahanKerja.save');
Route::get('admin/bahan-kerja/{id}/edit', [menuDuaController::class, 'editBahanKerja'])->name('bahanKerja.edit');
Route::put('admin/bahan-kerja/{id}/update', [menuDuaController::class, 'updateBahanKerja'])->name('bahanKerja.update');
Route::get('admin/bahan-kerja/{id}/hapus', [menuDuaController::class, 'hapusBahanKerja'])->name('bahanKerja.hapus');

// Route Menu Perangkat Kerja
Route::get('admin/perangkat-kerja', [menuDuaController::class, 'indexPerangkatKerja'])->name('perangkatKerja.index');
Route::post('admin/perangkat-kerja/jumlah_kolom', [menuDuaController::class, 'jml_kolom_bahan_kerja'])->name('perangkatKerja.jml_kolom');
Route::get('admin/perangkat-kerja/add', [menuDuaController::class, 'addPerangkatKerja'])->name('perangkatKerja.add');
Route::post('admin/perangkat-kerja/save', [menuDuaController::class, 'savePerangkatKerja'])->name('perangkatKerja.save');
Route::get('admin/perangkat-kerja/{id}/edit', [menuDuaController::class, 'editPerangkatKerja'])->name('perangkatKerja.edit');
Route::put('admin/perangkat-kerja/{id}/update', [menuDuaController::class, 'updatePerangkatKerja'])->name('perangkatKerja.update');
Route::get('admin/perangkat-kerja/{id}/hapus', [menuDuaController::class, 'hapusPerangkatKerja'])->name('perangkatKerja.hapus');

// Route Menu Tanggung Jawab
Route::get('admin/tanggung-jawab', [menuDuaController::class, 'indexTanggungJawab'])->name('tanggungJawab.index');
Route::get('admin/tanggung-jawab/add', [menuDuaController::class, 'addTanggungJawab'])->name('tanggungJawab.add');
Route::post('admin/tanggung-jawab/jumlah_kolom', [menuDuaController::class, 'jml_kolom_tanggung_jawab'])->name('tanggungJawab.jml_kolom');
Route::post('admin/tanggung-jawab/save', [menuDuaController::class, 'saveTanggungJawab'])->name('tanggungJawab.save');
Route::get('admin/tanggung-jawab/{id}/edit', [menuDuaController::class, 'editTanggungJawab'])->name('tanggungJawab.edit');
Route::put('admin/tanggung-jawab/{id}/update', [menuDuaController::class, 'updateTanggungJawab'])->name('tanggungJawab.update');
Route::get('admin/tanggung-jawab/{id}/hapus', [menuDuaController::class, 'hapusTanggungJawab'])->name('tanggungJawab.hapus');

// Route Menu Wewenang
Route::get('admin/wewenang', [menuTigaController::class, 'indexWewenang'])->name('Wewenang.index');
Route::get('admin/wewenang/add', [menuTigaController::class, 'addWewenang'])->name('Wewenang.add');
Route::post('admin/wewenang/jumlah_kolom', [menuTigaController::class, 'jml_kolom_wewenang'])->name('Wewenang.jml_kolom');
Route::post('admin/wewenang/save', [menuTigaController::class, 'saveWewenang'])->name('Wewenang.save');
Route::get('admin/wewenang/{id}/edit', [menuTigaController::class, 'editWewenang'])->name('Wewenang.edit');
Route::put('admin/wewenang/{id}/update', [menuTigaController::class, 'updateWewenang'])->name('Wewenang.update');
Route::get('admin/wewenang/{id}/hapus', [menuTigaController::class, 'hapusWewenang'])->name('Wewenang.hapus');

// Route Menu Korelasi Jabatan
Route::get('admin/korelasi-jabatan', [menuTigaController::class, 'indexKorelasiJabatan'])->name('KorelasiJabatan.index');
Route::get('admin/korelasi-jabatan/add', [menuTigaController::class, 'addKorelasiJabatan'])->name('KorelasiJabatan.add');
Route::post('admin/korelasi-jabatan/jumlah_kolom', [menuTigaController::class, 'jml_kolom_korelasi'])->name('KorelasiJabatan.jml_kolom');
Route::post('admin/korelasi-jabatan/save', [menuTigaController::class, 'saveKorelasiJabatan'])->name('KorelasiJabatan.save');
Route::get('admin/korelasi-jabatan/{id}/edit', [menuTigaController::class, 'editKorelasiJabatan'])->name('KorelasiJabatan.edit');
Route::put('admin/korelasi-jabatan/{id}/update', [menuTigaController::class, 'updateKorelasiJabatan'])->name('KorelasiJabatan.update');
Route::get('admin/korelasi-jabatan/{id}/hapus', [menuTigaController::class, 'hapusKorelasiJabatan'])->name('KorelasiJabatan.hapus');

// Route Menu Kondisi Lingkungan Kerja
Route::get('admin/kondisi-lingkungan-kerja', [menuTigaController::class, 'indexKondisiLingkunganKerja'])->name('KondisiLingkunganKerja.index');
Route::get('admin/kondisi-lingkungan-kerja/add', [menuTigaController::class, 'addKondisiLingkunganKerja'])->name('KondisiLingkunganKerja.add');
Route::post('admin/kondisi-lingkungan-kerja/jumlah_kolom', [menuTigaController::class, 'jml_kolom_kondisi_lingkungan_kerja'])->name('KondisiLingkunganKerja.jml_kolom');
Route::post('admin/kondisi-lingkungan-kerja/save', [menuTigaController::class, 'saveKondisiLingkunganKerja'])->name('KondisiLingkunganKerja.save');
Route::get('admin/kondisi-lingkungan-kerja/{id}/edit', [menuTigaController::class, 'editKondisiLingkunganKerja'])->name('KondisiLingkunganKerja.edit');
Route::put('admin/kondisi-lingkungan-kerja/{id}/update', [menuTigaController::class, 'updateKondisiLingkunganKerja'])->name('KondisiLingkunganKerja.update');
Route::get('admin/kondisi-lingkungan-kerja/{id}/hapus', [menuTigaController::class, 'hapusKondisiLingkunganKerja'])->name('KondisiLingkunganKerja.hapus');

// Route Menu Resiko Bahaya
Route::get('admin/resiko-bahaya', [menuTigaController::class, 'indexResikoBahaya'])->name('ResikoBahaya.index');
Route::get('admin/resiko-bahaya/add', [menuTigaController::class, 'addResikoBahaya'])->name('ResikoBahaya.add');
Route::post('admin/resiko-bahaya/jumlah_kolom', [menuTigaController::class, 'jml_kolom_resiko_bahaya'])->name('ResikoBahaya.jml_kolom');
Route::post('admin/resiko-bahaya/save', [menuTigaController::class, 'saveResikoBahaya'])->name('ResikoBahaya.save');
Route::get('admin/resiko-bahaya/{id}/edit', [menuTigaController::class, 'editResikoBahaya'])->name('ResikoBahaya.edit');
Route::put('admin/resiko-bahaya/{id}/update', [menuTigaController::class, 'updateResikoBahaya'])->name('ResikoBahaya.update');
Route::get('admin/resiko-bahaya/{id}/hapus', [menuTigaController::class, 'hapusResikoBahaya'])->name('ResikoBahaya.hapus');
