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
        <h4 class="card-title">Jabatan</h4>
        <a href="{{ route('jabatan.add') }}"
			class="btn btn-primary btn-rounded btn-fw">Tambah</a><br><br>
        <div class="table-responsive">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th style="text-align:center">NO</th>
                <th>Jabatan</th>
                <th>Atasan</th>
                <th>Unit Kerja</th>
				<th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->jabatan_nama }}</td>
                        <td>
                            {{ $item->atasan_nama }}
                        </td>
                        <td>{{ $item->unit_kerja }}</td>
                        <td>
                                <div style="display: flex; gap: 10px;">
                                    <a href="{{ route('jabatan.edit', $item->id) }}"
                                       class="btn btn-inverse-success btn-fw">Edit</a>
                                    <form method="POST" id="delete_form" action="{{ route('jabatan.hapus', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-inverse-danger btn-fw" onclick="return confirm('Hapus Data?')">Hapus</button>
                                    </form>
                                </div>
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
