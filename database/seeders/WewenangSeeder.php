<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WewenangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_wewenang = DB::connection('mysql2')
        ->table('wewenang')
        ->get();

        foreach($old_wewenang as $new){
            DB::connection('mysql')->table('wewenangs')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'uraian' => $new->uraian,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
