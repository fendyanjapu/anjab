<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan_kerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan_sopd',
        'bahan_kerja',
        'penggunaan_dalam_tugas',
    ];
}
