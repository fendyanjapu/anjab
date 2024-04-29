<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $old_jabatan = DB::connection('mysql2')->table('jabatan')->get();

        foreach($old_jabatan as $new){
            DB::connection('mysql')->table('jabatans')->insert([
                'nama_jabatan' => $new->nama_jabatan,
                'id_unit_kerja' => $new->id_unit_kerja,
                'kelas' => $new->kelas,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
