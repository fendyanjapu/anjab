<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KorelasiJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_korelasi_jabatan = DB::connection('mysql2')
        ->table('korelasi_jabatan')
        ->get();

        foreach($old_korelasi_jabatan as $new){
            DB::connection('mysql')->table('korelasi_jabatans')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'nm_jabatan' => $new->nm_jabatan,
                'unit_kerja_instansi' => $new->unit_kerja_instansi,
                'dalam_hal' => $new->dalam_hal,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
