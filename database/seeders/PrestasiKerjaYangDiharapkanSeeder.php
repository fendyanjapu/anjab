<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrestasiKerjaYangDiharapkanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_prestasi = DB::connection('mysql2')
        ->table('prestasi_kerja_yang_diharapkan')
        ->get();

        foreach($old_prestasi as $new){
            DB::connection('mysql')->table('prestasi_kerja_yang_diharapkans')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'prestasi' => $new->prestasi,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
