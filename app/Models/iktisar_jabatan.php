<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class iktisar_jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan_sopd',
        'iktisar',
    ];
}
