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
        <a href="<?php echo base_url('syarat_jabatan/add') ?>" class="btn btn-primary btn-rounded btn-fw">Tambah</a><br><br>
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
              <?php $no=0; foreach ($query->result() as $key): ?>
                <tr>
                  <td style="text-align:center"><?php echo ++$no ?></td>
                  <td><?php echo $key->nama_jabatan ?></td>
                  <td>
                      <?php
                        $this->db->where('id', $key->id_jabatan_sopd);
                        $q = $this->db->get('jabatan_sopd', 1);
                        foreach ($q->result() as $val) {
                            $id_atasan = $val->atasan;
                        }
                        $this->db->where('id_jabatan', $id_atasan);
                        $q = $this->db->get('jabatan', 1);
                        foreach ($q->result() as $val) {
                            echo $val->nama_jabatan;
                        }
                      ?>
                  </td>
                  <td><?php echo $key->keterampilan_kerja ?></td>
                  <td><?php echo $key->bakat_kerja ?></td>
                  <td><?php echo $key->temperamen_kerja ?></td>
									<td><?php echo $key->minat_kerja ?></td>
                  <td><?php echo $key->upaya_fisik ?></td>
                  <td><?php echo $key->jenis_kelamin ?></td>
									<td><?php echo $key->umur ?></td>
                  <td><?php echo $key->tinggi_badan ?></td>
                  <td><?php echo $key->berat_badan ?></td>
									<td><?php echo $key->postur_badan ?></td>
                  <td><?php echo $key->penampilan ?></td>
                  <td><?php echo $key->fungsi_pekerjaan ?></td>
                  <td>
                    <a href="<?php echo base_url('syarat_jabatan/edit/'.$key->key) ?>"
											class="btn btn-inverse-success btn-fw">Edit</a>
                    <a href="<?php echo base_url('syarat_jabatan/delete/'.$key->key) ?>"
											class="btn btn-inverse-danger btn-fw"
											onclick="return confirm('Hapus Data?')">Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
