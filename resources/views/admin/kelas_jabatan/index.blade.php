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
        <h4 class="card-title">Kelas Jabatan</h4>
        <!-- <a href="" class="btn btn-primary btn-rounded btn-fw">Tambah</a><br><br> -->
        <div class="table-responsive">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th style="text-align:center">NO</th>
                <th>Jabatan</th>
                <th>Kelas</th>
                <!-- <th></th> -->
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                  <td style="text-align:center">{{ $loop->iteration }}</td>
                  <td>{{ $item->jabatan_nama }}</td>
                  <td>{{ $item->kelas }}</td>
                  <!-- <td>
                    <a href=""
							class="btn btn-inverse-success btn-fw">Edit</a>
                    <a href=""
							class="btn btn-inverse-danger btn-fw"
							onclick="return confirm('Hapus Data?')">Hapus</a>
                  </td> -->
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
