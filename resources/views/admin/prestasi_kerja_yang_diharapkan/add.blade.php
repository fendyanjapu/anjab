@extends('admin.template')
@section('isi')

<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Prestasi Kerja Yang Diharapkan</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="{{ route('PrestasiKerja.save') }}">
        @csrf
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                <option value=""></option>
                @foreach ($data as $item)
                <option value="{{ $item->id }}">
                        {{ $item->jabatan_nama }}
                        @if ($item->atasan_id)
                            | atasan: {{ $item->atasan_nama }}
                        @endif
                </option>
                @endforeach
              </select>
            </div>
            <label class="col-sm-3 col-form-label">Prestasi Kerja Yang Diharapkan</label>
            <div class="col-sm-9">
              <input type="text" name="prestasi" class="form-control">
            </div>
          </div>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <button class="btn btn-light">Batal</button>
          </center>
        </form>
    </div>
  </div>
</div>

@endsection
