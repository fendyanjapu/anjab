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
        // Join tabel dari database kedua
        $old_jabatansopd = DB::connection('mysql2')
            ->table('jabatan_sopd')
            ->get();

            foreach ($old_jabatansopd as $newjs) {
                DB::connection('mysql')->table('jabatan_sopds')->insert([
                    'id' => $newjs->id,
                    'id_jabatan' => $newjs->id_jabatan,
                    'id_sopd' => $newjs->id_sopd,
                    'atasan' => $newjs->atasan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }
}
