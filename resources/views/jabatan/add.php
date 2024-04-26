<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Jabatan</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="<?php echo base_url('jabatan/save') ?>">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Jabatan</label>
            <div class="col-sm-9">
              <!--<input type="text" name="nama_jabatan" class="form-control" required>-->
              <textarea  name="nama_jabatan" class="form-control" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Unit Kerja</label>
            <div class="col-sm-9">
              <select class="form-control" name="id_unit_kerja" required>
                <option value=""></option>
                <?php foreach ($q_unit_kerja->result() as $key): ?>
                  <option value="<?php echo $key->id ?>">
                    <?php echo $key->jenis_unit_kerja ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kelas Jabatan</label>
            <div class="col-sm-9">
              <input type="text" name="kelas" class="form-control" required>
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
