@extends('admin.template')
@section('isi')

<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Kelas Jabatan</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="<?php echo base_url('kelas_jabatan/update') ?>">
          <?php foreach ($query->result() as $key): ?>
            <input type="hidden" name="id" value="<?php echo $key->id ?>">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select class="form-control" name="id_jabatan_sopd">
                  <option value=""></option>
                  <?php foreach ($q_jabatan->result() as $var): ?>
                    <option value="<?php echo $var->id ?>" <?php if ($key->id_jabatan_sopd==$var->id): ?>
                      selected
                    <?php endif; ?>>
                      <?php echo $var->nama_jabatan ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <label class="col-sm-3 col-form-label">Kelas</label>
              <div class="col-sm-9">
                <input type="text" name="kelas" value="<?php echo $key->kelas ?>"class="form-control">
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
@endsection
