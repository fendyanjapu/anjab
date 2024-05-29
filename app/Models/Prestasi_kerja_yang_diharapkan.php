<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi_kerja_yang_diharapkan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan_sopd',
        'prestasi',
    ];
}
