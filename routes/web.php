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

