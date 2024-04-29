<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SopdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_sopd = DB::connection('mysql2')->table('sopd')->get();

        foreach($old_sopd as $new){
            DB::connection('mysql')->table('sopds')->insert([
                'nama_sopd' => $new->nama_sopd,
                'username' => $new->username,
                'password' => $new->password,
                'level' => $new->level,
                'jenis_sopd'=> $new->jenis_sopd,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
