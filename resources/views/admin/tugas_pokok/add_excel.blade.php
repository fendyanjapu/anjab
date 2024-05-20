@extends('admin.template')
@section('isi')

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
			<h3 style="color: black;">*NOTE</h3>
			<h3 style="color: black;">1. Download contoh file excel untuk input data ABK
				<a href="{{ route('tugasPokok.download') }}" target="_blank">disini</a></h3>
			<h3 style="color: black;">2. Copy data yang ingin diinput ke file tersebut, kemudian simpan</h3>
			<h3 style="color: black;">3. Pilih nama jabatan</h3>
			<h3 style="color: black;">4. Klik tombol choose file, pilih file yang tadi sudah disimpan</h3>
			<br>
      <form class="forms-sample" method="post" enctype="multipart/form-data"
        action="{{ route('tugasPokok.saveExcel') }}">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                <option value=""></option>
                @foreach ($jsopd as $item)
                    <option value="{{ $item->id }}">
                            {{ $item->jabatan_nama }}
                            @if ($item->atasan_id)
                                | atasan: {{ $item->atasan_nama }}
                            @endif
                    </option>
                @endforeach
              </select>
            </div>
            <label class="col-sm-3 col-form-label">File Excel</label>
            <div class="col-sm-9">
              <input type="file" name="file" class="form-control" id="file"
              required accept=".xls, .xlsx" />
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
