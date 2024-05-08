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
        action="<?php echo base_url('jabatan_sopd/save') ?>">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="id_jabatan" required>
                <option value=""></option>
                <?php foreach ($q_jabatan->result() as $key): ?>
                  <option value="<?php echo $key->id_jabatan ?>"><?php echo $key->nama_jabatan ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <label class="col-sm-3 col-form-label">Atasan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="atasan">
                <option value=""></option>
                <?php foreach ($q_jabatan->result() as $key): ?>
                  <option value="<?php echo $key->id_jabatan ?>"><?php echo $key->nama_jabatan ?></option>
                <?php endforeach; ?>
              </select>
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
