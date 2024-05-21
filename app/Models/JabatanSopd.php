<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanSopd extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan',
        'id_sopd',
        'atasan',
    ];

    public function Relsopd(){
        return $this->belongsTo(Sopd::class, 'id_sopd', 'id_sopd');
    }

    public function RelJab(){
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }


}
