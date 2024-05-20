<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\menuSatuController;

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

// Route Menu Hasil Kinerja
Route::get('admin/hasil-kinerja', [menuDuaController::class, 'indexHasilKinerja'])->name('hasilkinerja.index');
Route::get('admin/hasil-kinerja/add', [menuDuaController::class, 'addTuHasilKinerja'])->name('hasilkinerja.add');
Route::post('admin/hasil-kinerja/save', [menuDuaController::class, 'saveTHasilKinerja'])->name('hasilkinerja.save');
Route::get('admin/hasil-kinerja/{id}/edit', [menuDuaController::class, 'editTHasilKinerja'])->name('hasilkinerja.edit');
Route::put('admin/hasil-kinerja/{id}/update', [menuDuaController::class, 'updatHasilKinerja'])->name('hasilkinerja.update');
Route::get('admin/hasil-kinerja/{id}/hapus', [menuDuaController::class, 'hapusHasilKinerja'])->name('hasilkinerja.hapus');
