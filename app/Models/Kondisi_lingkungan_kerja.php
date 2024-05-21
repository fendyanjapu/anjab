<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi_lingkungan_kerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jabatan_sopd',
        'aspek',
        'faktor',
    ];
}
