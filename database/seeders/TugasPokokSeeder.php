<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TugasPokokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $old_tugas = DB::connection('mysql2')
        ->table('tugas_pokok')
        ->get();

        foreach($old_tugas as $new){
            DB::connection('mysql')->table('tugas_pokoks')->insert([
                'id' => $new->id,
                'id_jabatan_sopd' => $new->id_jabatan_sopd,
                'uraian_tugas' => $new->uraian_tugas,
                'hasil_kerja' => $new->hasil_kerja,
                'jumlah_hasil' => $new->jumlah_hasil,
                'waktu_penyelesaian_jam' => $new->waktu_penyelesaian_jam,
                'waktu_efektif' => $new->waktu_efektif,
                'kebutuhan_pegawai' => $new->kebutuhan_pegawai,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
