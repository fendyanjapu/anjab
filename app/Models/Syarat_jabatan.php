<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syarat_jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan_sopd','keterampilan_kerja','bakat_kerja','temperamen_kerja','minat_kerja'
        ,'upaya_fisik','jenis_kelamin','umur','tinggi_badan','berat_badan','postur_badan','penampilan','fungsi_pekerjaan'
    ];

}
