@extends('../../template')
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
        <a href=""
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
            {{-- <tbody>
              <?php $no=0; foreach ($query->result() as $key): ?>
                <tr>
                  <td style="text-align:center"><?php echo ++$no ?></td>
                  <td><?php echo $key->nama_jabatan ?></td>
                  <td>
										<?php
											$this->db->where('id_jabatan', $key->atasan);
											$atasan = $this->db->get('jabatan');
											foreach ($atasan->result() as $var) {
												echo $var->nama_jabatan;
											}
										?>
									</td>
                  <td><?php echo $key->jenis_unit_kerja ?></td>
                  <td>
                    <a href="<?php echo base_url('jabatan_sopd/edit/'.$key->idjab) ?>"
											class="btn btn-inverse-success btn-fw">Edit</a>
                    <a href="<?php echo base_url('jabatan_sopd/delete/'.$key->idjab) ?>"
											class="btn btn-inverse-danger btn-fw"
											onclick="return confirm('Hapus Data?')">Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody> --}}
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

    
@endsection
