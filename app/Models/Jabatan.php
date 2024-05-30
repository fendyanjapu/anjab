<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jabatan','id_unit_kerja','kelas'
    ];

    protected $primaryKey = 'id_jabatan';

    public function UnitKerja(){
        return $this->belongsTo(Unit_kerja::class, 'id_unit_kerja','id');
    }
}
