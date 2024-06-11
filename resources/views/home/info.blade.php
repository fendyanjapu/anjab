<html>

<head>
    <title>Informasi Jabatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        .text-top{
            margin-top: -10px;
        }
        .text-top .text-1 {
            font-weight: bold;
            font-size: 18px;
        }
        .text-top .text-2 {
            font-size: 17px;
        }
        .text-body {
            margin-top: 10px;
        }
        .text-body ol {
            margin-left: -23px;
        }
        .text-body ol li {
            margin-top: 5px;
            font-size: 14px;
        }
        .text-body ol li span.titik-dua {
            margin-left: 80px;
        }
        .text-body ol li span.text-content{
            margin-left: 12px;
            font-size: 12px;
        }
        .text-content {
            display: block;
            text-indent: -65px;
            padding-left: 65px;
        }
        table tr td,
        table tr th {
            font-size: 8pt;
        }

    </style>
    <div class="text-top text-center">
        <div class="text-1">
            INFORMASI JABATAN
        </div>
        <div class="text-2">
            Kecamatan Alalak
        </div>
    </div>
    <div class="text-body">
        <ol>
            <li>
                NAMA JABATAN
                <span class="titik-dua">:</span>
                <span class="text-content">Camat Alalak</span>
            </li>
            <li>
                KODE JABATAN
                <span class="titik-dua">:</span>
                <span class="text-content"></span>
            </li>
            <li>
                UNIT KERJA
                <span style="margin-left: 105px">:</span>
                <span class="text-content">Struktural</span>
            </li>
            <li>
                IKTISAR JABATAN
                <span style="margin-left: 65px">:</span>
                <span class="text-content">
                    Memimpin Kecamatan dalam pelaksanaan tugas merumuskan program, mengatur dan
                    memberi petunjuk, mendistribusikan tugas, mengarahkan, merumuskan konsep,
                    menyelia, mengevaluasi, menilai kinerja dan melaporkan penyelengaraan pemerintahan
                    di wilayah kecamatan serta mengendalikan sub bagian umum dan kepegawaian, sub
                    bagian perencanaan keuangan dan asset, seksi pemerintahan, seksi pemberdayaan
                    masyarakat, seksi kesejahteraan Rakyat, seksi Pelayanan, seksi ketentraman dan
                    ketertiban sesuai petunjuk teknis (juknis) untuk kelancaran pelaksanaan tugas.
                </span>
            </li>
        </ol>
    </div>

    {{-- <table class="table mt-4 table-bordered border">
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Masuk </th>
                <th>Nama</th>
                <th>Unit Kerja </th>
                <th>Diterima Melalui</th>
                <th>Tgl Permohonan</th>
                <th>Uraian Permohonan</th>
                <th>Tgl Tindak Lanjut</th>
                <th>Tindak Lanjut</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($data as $item)

            @php
                $cekwktu = $item->waktu_layanan->isEmpty() ? null : $item->waktu_layanan->last();
            @endphp

            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ (date('d/m/Y', STRTOTIME($item->tgl_input))) }}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->unit_kerja}}</td>
                <td>{{$item->via_diterima}}</td>
                <td>{{ (date('d/m/Y', STRTOTIME($item->tgl_diterima))) }}</td>
                <td>{{$item->uraian_permohonan}}</td>

                @if ($cekwktu)
                        <td>{{ $cekwktu->tindak_lanjut }}</td>
                    @else
                        <td>-</td>
                    @endif

                    @if ($cekwktu)
                        <td>{{ date('d-m-Y', strtotime($cekwktu->tgl_tindak_lanjut)) }}</td>
                    @else
                        <td>-</td>
                    @endif


                <td style="max-width: 80px">
                    {{ $item->status }}
                </td>

            </tr>
            @endforeach
        </tbody>

    </table> --}}

</body>

</html>
