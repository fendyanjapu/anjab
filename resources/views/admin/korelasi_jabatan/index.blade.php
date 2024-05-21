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
        <h4 class="card-title">Korelasi Jabatan</h4>
        <a href="{{ route('KorelasiJabatan.add') }}" class="btn btn-primary btn-rounded btn-fw">Tambah</a><br><br>
        <div class="table-responsive">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th style="text-align:center">NO</th>
                <th>Jabatan</th>
                <th>Atasan</th>
                <th>Nama Jabatan/Korelasi Jabatan</th>
                <th>Unit Kerja/Instansi</th>
                <th>Dalam Hal</th>
                <th></th>
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
                  <td>{{ $item->nm_jabatan }}</td>
                  <td>{{ $item->unit_kerja_instansi }}</td>
                  <td>{{ $item->dalam_hal }}</td>
                  <td>
                    <a href="{{ route('KorelasiJabatan.edit', $item->id) }}"
											class="btn btn-inverse-success btn-fw">Edit</a>
                    <a href="{{ route('KorelasiJabatan.hapus', $item->id) }}"
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
