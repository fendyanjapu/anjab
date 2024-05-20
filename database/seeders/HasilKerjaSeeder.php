<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HasilKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_hasil = DB::connection('mysql2')
        ->table('hasil_kerja')
        ->get();

        foreach($old_hasil as $new){
            DB::connection('mysql')->table('hasil_kerjas')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'hasil' => $new->hasil,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
