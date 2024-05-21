@extends('admin.template')
@section('isi')
<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Hasil Kerja</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="{{ route('hasilKerja.update', $data->id) }}">
        @csrf
        @method('PUT')
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                  <option value=""></option>
                  @foreach ($jsopd as $item)
                    <option value="{{ $item->id }}"  {{ $item->id == $data->id_jabatan_sopd ? 'selected' : '' }}>
                            {{ $item->jabatan_nama }}
                            @if ($item->atasan_id)
                                | atasan: {{ $item->atasan_nama }}
                            @endif
                    </option>
                    @endforeach
                </select>
              </div>
              <label class="col-sm-3 col-form-label">Hasil</label>
              <div class="col-sm-9">
                <input type="text" name="hasil" value="{{ $data->hasil }}" class="form-control">
              </div>
            </div>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="{{ route('hasilKerja.index') }}" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>

@endsection
