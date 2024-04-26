<script>
	$(document).ready(function(){
		$('#jumlah_kolom').change(function(){
			var jml = $(this).val();
			$.ajax({
				type   : "POST",
				url    : "<?php echo base_url('perangkat_kerja/jml_kolom') ?>",
				data   : 'jml='+jml,
				cache  : false,
				success: function(klm){
					$('#kolom').html(klm);
				}
			});
		});
	});
</script>
<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Perangkat Kerja</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="<?php echo base_url('perangkat_kerja/save') ?>">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                <option value=""></option>
                <?php foreach ($q_jabatan->result() as $var): ?>
                  <option value="<?php echo $var->id ?>">
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
            <label class="col-sm-3 col-form-label">Jumlah</label>
            <div class="col-sm-9">
              <select name="jumlah_kolom" id="jumlah_kolom" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
          </div>
          <div id="kolom">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Perangkat Kerja</label>
              <div class="col-sm-9">
                <input type="text" name="perangkat_kerja1" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Penggunaan Untuk Tugas</label>
              <div class="col-sm-9">
                <input type="text" name="penggunaan_untuk_tugas1" class="form-control">
              </div>
            </div>
          </div>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="#" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>
