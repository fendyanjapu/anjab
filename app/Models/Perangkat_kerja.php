<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkat_kerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan_sopd',
        'perangkat_kerja',
        'penggunaan_untuk_tugas',
    ];
}
