<?php

namespace App\Imports;

use App\Models\Tugas_pokok;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TugasPokok implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $collection){

        $idjabatan = $_REQUEST['id_jabatan_sopd'];
        $arr = [];

        $row = $collection->slice(1);

        foreach($row as $v) {
            if (!empty($v[1]) && !empty($v[5])) {
                $arr[] = $v;

                $hitung = ($v[6] != 0) ? ($v[5] * $v[7] / $v[6]) : 0;

                Tugas_pokok::create([
                    'id_jabatan_sopd' => $idjabatan,
                    'uraian_tugas' => $v[1],
                    'hasil_kerja' => $v[4],
                    'jumlah_hasil' => $v[7],
                    'waktu_penyelesaian_jam' => $v[5],
                    'waktu_efektif' => $v[6],
                    'kebutuhan_pegawai' => number_format($hitung, 4),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
