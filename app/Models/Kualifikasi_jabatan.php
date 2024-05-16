<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kualifikasi_jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan_sopd','pendidikan_formal',
        'pendidikan_pelatihan','pengalaman_kerja'
    ];
}
