<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SyaratJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_syarat_jabatan = DB::connection('mysql2')
        ->table('syarat_jabatan')
        ->get();

        foreach($old_syarat_jabatan as $new){
            DB::connection('mysql')->table('syarat_jabatans')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'keterampilan_kerja' => $new->keterampilan_kerja,
                'bakat_kerja' => $new->bakat_kerja,
                'temperamen_kerja' => $new->temperamen_kerja,
                'minat_kerja' => $new->minat_kerja,
                'upaya_fisik' => $new->upaya_fisik,
                'jenis_kelamin' => $new->jenis_kelamin,
                'umur' => $new->umur,
                'tinggi_badan' => $new->tinggi_badan,
                'berat_badan' => $new->berat_badan,
                'postur_badan' => $new->postur_badan,
                'penampilan' => $new->penampilan,
                'fungsi_pekerjaan' => $new->fungsi_pekerjaan,
                'created_at' => NOW(),
                'updated_at' => NOW(),

            ]);
        }
    }
}
