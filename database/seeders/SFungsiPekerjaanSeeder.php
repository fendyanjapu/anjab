<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SFungsiPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_s_fungsi_pekerjaan = DB::connection('mysql2')
        ->table('s_fungsi_pekerjaan')
        ->get();

        foreach($old_s_fungsi_pekerjaan as $new){
            DB::connection('mysql')->table('s_fungsi_pekerjaans')->insert([
                'id' => $new->id,
                'value' => $new->value,
                'ket' => $new->ket,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
