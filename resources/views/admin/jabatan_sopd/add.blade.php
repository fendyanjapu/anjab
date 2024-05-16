@extends('admin.template')
@section('isi')
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
        action="{{ route('jabatan.save') }}">
        @csrf
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="id_jabatan" required>
                <option value=""></option>
                @foreach ($jabatan as $item)
                    <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                @endforeach
              </select>
            </div>
            <label class="col-sm-3 col-form-label">Atasan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="atasan">
                <option value=""></option>
                @foreach ($jabatan as $item)
                    <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                @endforeach
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
@endsection
