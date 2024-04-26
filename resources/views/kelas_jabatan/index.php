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
        <!-- <a href="<?php echo base_url('kelas_jabatan/add') ?>" class="btn btn-primary btn-rounded btn-fw">Tambah</a><br><br> -->
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
              <?php $no=0; foreach ($query->result() as $key): ?>
                <tr>
                  <td style="text-align:center"><?php echo ++$no ?></td>
                  <td><?php echo $key->nama_jabatan ?></td>
                  <td><?php echo $key->kelas ?></td>
                  <!-- <td>
                    <a href="<?php echo base_url('kelas_jabatan/edit/'.$key->key) ?>"
											class="btn btn-inverse-success btn-fw">Edit</a>
                    <a href="<?php echo base_url('kelas_jabatan/delete/'.$key->key) ?>"
											class="btn btn-inverse-danger btn-fw"
											onclick="return confirm('Hapus Data?')">Hapus</a>
                  </td> -->
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
