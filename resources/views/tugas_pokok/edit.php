<script>
	$(document).ready(function(){
		$('#jumlah_hasil').keyup(function(){
      jumlah_hasil = $(this).val();
      waktu_penyelesaian_jam = $('#waktu_penyelesaian_jam').val();
      kebutuhan_pegawai = (waktu_penyelesaian_jam * jumlah_hasil) / 72000;
      $('#kebutuhan_pegawai').val(kebutuhan_pegawai);
    });
    $('#waktu_penyelesaian_jam').keyup(function(){
      jumlah_hasil = $('#jumlah_hasil').val();
      waktu_penyelesaian_jam = $(this).val();
      kebutuhan_pegawai = (waktu_penyelesaian_jam * jumlah_hasil) / 72000;
      $('#kebutuhan_pegawai').val(kebutuhan_pegawai);
    });
	});
</script>
<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Tugas Pokok</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="<?php echo base_url('tugas_pokok/update') ?>">
          <?php foreach ($query->result() as $key): ?>
						<input type="hidden" name="id" value="<?php echo $key->id ?>">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                  <option value=""></option>
                  <?php foreach ($q_jabatan->result() as $var): ?>
                    <option value="<?php echo $var->id ?>" <?php if ($key->id_jabatan_sopd==$var->id): ?>
                      selected
                    <?php endif; ?>>
                      <?php echo $var->nama_jabatan ?>
											<?php
                        $this->db->where('id_jabatan', $var->atasan);
                        $q = $this->db->get('jabatan');
                        foreach ($q->result() as $value) {
                          echo "| atasan: ";
                          echo $value->nama_jabatan;
                        }
                      ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <label class="col-sm-3 col-form-label">Uraian Tugas</label>
              <div class="col-sm-9">
                <input type="text" name="uraian_tugas"
                value="<?php echo $key->uraian_tugas ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Satuan Hasil</label>
              <div class="col-sm-9">
                <input type="text" name="hasil_kerja"
                value="<?php echo $key->hasil_kerja ?>"class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Jumlah Hasil</label>
              <div class="col-sm-9">
                <input type="text" name="jumlah_hasil" id="jumlah_hasil" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                value="<?php echo $key->jumlah_hasil ?>"class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Waktu Penyelesaian (Menit)</label>
              <div class="col-sm-9">
                <input type="text" name="waktu_penyelesaian_jam" id="waktu_penyelesaian_jam" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                value="<?php echo $key->waktu_penyelesaian_jam ?>"class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Waktu Efektif (Menit)</label>
              <div class="col-sm-9">
                <input type="text" name="waktu_efektif" id="waktu_efektif"
                value="<?php echo $key->waktu_efektif ?>" class="form-control" readonly>
              </div>
              <label class="col-sm-3 col-form-label">Kebutuhan Pegawai</label>
              <div class="col-sm-9">
                <input type="text" name="kebutuhan_pegawai" id="kebutuhan_pegawai"
                value="<?php echo $key->kebutuhan_pegawai ?>" class="form-control" readonly>
              </div>
            </div>
          <?php endforeach; ?>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="#" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>