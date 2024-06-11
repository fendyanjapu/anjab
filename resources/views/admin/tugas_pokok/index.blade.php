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
        <h4 class="card-title">Tugas Pokok</h4>
        <a href="{{ route('tugasPokok.add') }}" class="btn btn-primary btn-rounded btn-fw">
					Tambah</a><br><br>
					<a href="{{ route('tugasPokok.excel') }}" class="btn btn-success btn-rounded btn-fw">
						Input Data Excel</a><br><br>
        <div class="table-responsive">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th style="text-align:center">NO</th>
                <th>Jabatan</th>
                <th>Atasan</th>
                <th>Uraian Tugas</th>
                <th>Satuan Hasil</th>
                <th>Jumlah Hasil</th>
                <th>Waktu Penyelesaian (Jam)</th>
                <th>Waktu Efektif</th>
                <th>Kebutuhan Pegawai</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $item->jabatan_nama }}</td>
                    <td>{{ $item->atasan_nama }}</td>
                    <td>{{ $item->uraian_tugas }}</td>
                    <td>{{ $item->hasil_kerja }}</td>
                    <td>{{ $item->jumlah_hasil }}</td>
                    <td>{{ $item->waktu_penyelesaian_jam }}</td>
                    <td>{{ $item->waktu_efektif }}</td>
                    <td>{{ number_format($item->kebutuhan_pegawai,4) }}</td>
                    <td>
                        <a href="{{ route('tugasPokok.edit', $item->id) }}"
                                                class="btn btn-inverse-success btn-fw">Edit</a>
                        <a href="{{ route('tugasPokok.hapus', $item->id) }}"
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
