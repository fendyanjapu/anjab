<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerangkatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_perangkat = DB::connection('mysql2')
        ->table('perangkat_kerja')
        ->get();

        foreach($old_perangkat as $new){
            DB::connection('mysql')->table('perangkat_kerjas')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'perangkat_kerja' => $new->perangkat_kerja,
                'penggunaan_untuk_tugas' => $new->penggunaan_untuk_tugas,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
