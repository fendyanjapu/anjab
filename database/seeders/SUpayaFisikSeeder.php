<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SUpayaFisikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_s_upaya_fisik = DB::connection('mysql2')
        ->table('s_upaya_fisik')
        ->get();

        foreach($old_s_upaya_fisik as $new){
            DB::connection('mysql')->table('s_upaya_fisiks')->insert([
                'id' => $new->id,
                'value' => $new->value,
                'ket' => $new->ket,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
