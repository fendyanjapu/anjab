<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Kualifikasi Jabatan</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="<?php echo base_url('kualifikasi_jabatan/save') ?>">
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
            <label class="col-sm-3 col-form-label">Pendidikan Formal</label>
            <div class="col-sm-9">
              <input type="text" name="pendidikan_formal" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Pendidikan Pelatihan</label>
            <div class="col-sm-9">
              <input type="text" name="pendidikan_pelatihan" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Pengalaman Kerja</label>
            <div class="col-sm-9">
              <input type="text" name="pengalaman_kerja" class="form-control">
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
