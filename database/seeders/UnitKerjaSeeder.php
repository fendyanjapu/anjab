<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_unit_kerja = DB::connection('mysql2')->table('unit_kerja')->get();

        foreach ($old_unit_kerja as $new) {
            DB::connection('mysql')->table('unit_kerjas')->insert([
                'id' => $new->id,
                'jenis_unit_kerja' => $new->jenis_unit_kerja,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
