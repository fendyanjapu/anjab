<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResikoBahayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_resiko_bahaya = DB::connection('mysql2')
        ->table('risiko_bahaya')
        ->get();

        foreach($old_resiko_bahaya as $new){
            DB::connection('mysql')->table('resiko_bahayas')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'nama_resiko' => $new->nama_resiko,
                'penyebab' => $new->penyebab,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
