<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class STemperamenKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_s_temperamen_kerja = DB::connection('mysql2')
        ->table('s_temperamen_kerja')
        ->get();

        foreach($old_s_temperamen_kerja as $new){
            DB::connection('mysql')->table('s_temperamen_kerjas')->insert([
                'id' => $new->id,
                'value' => $new->value,
                'ket' => $new->ket,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
