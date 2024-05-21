<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TanggungJawabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_tanggung_jawab = DB::connection('mysql2')
        ->table('tanggung_jawab')
        ->get();

        foreach($old_tanggung_jawab as $new){
            DB::connection('mysql')->table('tanggung_jawabs')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'uraian' => $new->uraian,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
