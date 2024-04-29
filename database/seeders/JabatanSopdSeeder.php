<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSopdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_jabatansopd = DB::connection('mysql2')->table('jabatan_sopd')->get();

        foreach($old_jabatansopd as $new){
            DB::connection('mysql')->table('jabatan_sopds')->insert([
                'id_jabatan' => $new->id_jabatan,
                'id_sopd' => $new->id_sopd,
                'atasan' => $new->atasan,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
