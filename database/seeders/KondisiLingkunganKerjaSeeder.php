<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KondisiLingkunganKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_kondisi_lingkungan = DB::connection('mysql2')
        ->table('kondisi_lingkungan_kerja')
        ->get();

        foreach($old_kondisi_lingkungan as $new){
            DB::connection('mysql')->table('kondisi_lingkungan_kerjas')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'aspek' => $new->aspek,
                'faktor' => $new->faktor,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
