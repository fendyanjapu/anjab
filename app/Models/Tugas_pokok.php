<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas_pokok extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jabatan_sopd','uraian_tugas',
        'hasil_kerja','jumlah_hasil',
        'waktu_penyelesaian_jam','waktu_efektif',
        'kebutuhan_pegawai'
    ];
}
