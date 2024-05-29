@extends('admin.template')
@section('isi')
<script>
	$(document).ready(function(){
		$('#myTable').DataTable();
	});
</script>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Syarat Jabatan</h4>
        <a href="{{ route('SyaratJabatan.add') }}" class="btn btn-primary btn-rounded btn-fw">Tambah</a><br><br>
        <div class="table-responsive">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th style="text-align:center" rowspan="2">NO</th>
                <th rowspan="2">Jabatan</th>
                <th rowspan="2">Atasan</th>
                <th rowspan="2">Keterampilan Kerja</th>
                <th rowspan="2">Bakat Kerja</th>
                <th rowspan="2">Temperamen kerja</th>
                <th rowspan="2">Minat Kerja</th>
                <th rowspan="2">Upaya Fisik</th>
                <th style="text-align:center" colspan="6">Kondisi Fisik</th>
                <th rowspan="2">Fungsi Pekerjaan</th>
                <th rowspan="2"></th>
              </tr>
							<tr>
								<th>Jenis kelamin</th>
                <th>Umur</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Postur Badan</th>
                <th>Penampilan</th>
							</tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                  <td style="text-align:center">{{ $loop->iteration }}</td>
                  <td>{{ $item->jabatan_nama }}</td>
                  <td>
                        {{ $item->atasan_nama }}
                  </td>
                  <td>{{ $item->keterampilan_kerja }}</td>
                  <td>{{ $item->bakat_kerja }}</td>
                  <td>{{ $item->temperamen_kerja }}</td>
				  <td>{{ $item->minat_kerja }}</td>
                  <td>{{ $item->upaya_fisik }}</td>
                  <td>{{ $item->jenis_kelamin }}</td>
				  <td>{{ $item->umur }}</td>
                  <td>{{ $item->tinggi_badan }}</td>
                  <td>{{ $item->berat_badan }}</td>
				  <td>{{ $item->postur_badan }}</td>
                  <td>{{ $item->penampilan }}</td>
                  <td>{{ $item->fungsi_pekerjaan }}</td>
                  <td>
                    <a href="{{ route('SyaratJabatan.edit', $item->id) }}"
											class="btn btn-inverse-success btn-fw">Edit</a>
                    <a href="{{ route('SyaratJabatan.hapus', $item->id) }}"
											class="btn btn-inverse-danger btn-fw"
											onclick="return confirm('Hapus Data?')">Hapus</a>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
