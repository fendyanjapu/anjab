<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IktisarJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_iktisar = DB::connection('mysql2')
        ->table('iktisar_jabatan')
        ->get();

        foreach($old_iktisar as $new){
            DB::connection('mysql')->table('iktisar_jabatans')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'iktisar' => $new->iktisar,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
