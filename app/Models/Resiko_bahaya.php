<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resiko_bahaya extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jabatan_sopd',
        'nama_resiko',
        'penyebab',
    ];
}
