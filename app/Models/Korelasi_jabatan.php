<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korelasi_jabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jabatan_sopd',
        'nm_jabatan',
        'unit_kerja_instansi',
        'dalam_hal'
    ];
}
