<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KualifikasiJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_kualifikasi = DB::connection('mysql2')
        ->table('kualifikasi_jabatan')
        ->get();

        foreach($old_kualifikasi as $new){
            DB::connection('mysql')->table('kualifikasi_jabatans')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'pendidikan_formal' => $new->pendidikan_formal,
                'pendidikan_pelatihan' => $new->pendidikan_pelatihan,
                'pengalaman_kerja' => $new->pengalaman_kerja,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
