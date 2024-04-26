<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Ubah Password</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="<?php echo base_url('pengaturan/ubah_password') ?>">
          <div class="form-group row">
            <input type="hidden" name="username" value="<?php echo $username ?>">
            <label class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-9">
              <input type="password" name="pass_lama" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-9">
              <input type="password" name="pass_baru" class="form-control">
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
