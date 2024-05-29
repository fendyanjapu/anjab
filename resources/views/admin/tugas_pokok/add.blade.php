@extends('admin.template')
@section('isi')

<script>
	$(document).ready(function(){
		$('#jumlah_hasil').keyup(function(){
      jumlah_hasil = $(this).val();
      waktu_penyelesaian_jam = $('#waktu_penyelesaian_jam').val();
      kebutuhan_pegawai = (waktu_penyelesaian_jam * jumlah_hasil) / 72000;
      $('#kebutuhan_pegawai').val(kebutuhan_pegawai);
    });
    $('#waktu_penyelesaian_jam').keyup(function(){
      jumlah_hasil = $('#jumlah_hasil').val();
      waktu_penyelesaian_jam = $(this).val();
      kebutuhan_pegawai = (waktu_penyelesaian_jam * jumlah_hasil) / 72000;
      $('#kebutuhan_pegawai').val(kebutuhan_pegawai);
    });
	});

</script>
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
        <form class="forms-sample" method="post"
        action="{{ route('tugasPokok.save') }}">
        @csrf
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select class="js-example-basic-single w-100" name="id_jabatan_sopd" class="form-control">
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
            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
            <div class="col-sm-9">
              <input type="text" name="uraian_tugas" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Satuan Hasil</label>
            <div class="col-sm-9">
              <input type="text" name="hasil_kerja" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Jumlah Hasil</label>
            <div class="col-sm-9">
              <input type="text" name="jumlah_hasil" id="jumlah_hasil"
              onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Waktu Penyelesaian (Menit)</label>
            <div class="col-sm-9">
              <input type="text" name="waktu_penyelesaian_jam" id="waktu_penyelesaian_jam"
              onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
            </div>
            <label class="col-sm-3 col-form-label">Waktu Efektif (Menit)</label>
            <div class="col-sm-9">
              <input type="text" name="waktu_efektif" value="72000" class="form-control" readonly>
            </div>
            <label class="col-sm-3 col-form-label">Kebutuhan Pegawai</label>
            <div class="col-sm-9">
              <input type="text" name="kebutuhan_pegawai" id="kebutuhan_pegawai" class="form-control" readonly>
            </div>
          </div>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="{{ route('tugasPokok.index') }}" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>

@endsection
