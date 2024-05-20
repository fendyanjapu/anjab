<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BahanKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_bahan = DB::connection('mysql2')
        ->table('bahan_kerja')
        ->get();

        foreach($old_bahan as $new){
            DB::connection('mysql')->table('bahan_kerjas')->insert([
                'id' => $new->id,
                'bahan_kerja' => $new->bahan_kerja,
                'penggunaan_dalam_tugas' => $new->penggunaan_dalam_tugas,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
