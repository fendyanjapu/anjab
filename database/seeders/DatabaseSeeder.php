<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SopdSeeder::class,
            unitkerjaSeeder::class,
            JabatanSeeder::class,
            JabatanSopdSeeder::class,
            KualifikasiJabatanSeeder::class,
            IktisarJabatanSeeder::class,
            TugasPokokSeeder::class,
            HasilKerjaSeeder::class,
            BahanKerjaSeeder::class,
            PerangkatKerjaSeeder::class,
            TanggungJawabSeeder::class,
            WewenangSeeder::class,
            KorelasiJabatanSeeder::class,
            KondisiLingkunganKerjaSeeder::class,
            ResikoBahayaSeeder::class,
            SyaratJabatanSeeder::class,
            PrestasiKerjaYangDiharapkanSeeder::class,
        ]);
    }
}
