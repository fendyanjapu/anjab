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
        action="{{ route('tugasPokok.update', $data->id) }}">
        @csrf
        @method('PUT')
			<input type="hidden" name="id" value="{{ ($data->id) }}">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                  <option value=""></option>
                  @foreach ($jsopd as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $data->id_jabatan_sopd ? 'selected' : '' }}>{{ $item->jabatan_nama }}

                  @if ($item->atasan_id)
                      | atasan: {{ $item->atasan_nama }}
                  @endif
                  </option>
                @endforeach
                </select>
              </div>
              <label class="col-sm-3 col-form-label">Uraian Tugas</label>
              <div class="col-sm-9">
                <input type="text" name="uraian_tugas"
                value="{{ $data->uraian_tugas }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Satuan Hasil</label>
              <div class="col-sm-9">
                <input type="text" name="hasil_kerja"
                value="{{ $data->hasil_kerja }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Jumlah Hasil</label>
              <div class="col-sm-9">
                <input type="text" name="jumlah_hasil" id="jumlah_hasil" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                value="{{$data->jumlah_hasil}}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Waktu Penyelesaian (Menit)</label>
              <div class="col-sm-9">
                <input type="text" name="waktu_penyelesaian_jam" id="waktu_penyelesaian_jam" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                value="{{ $data->waktu_penyelesaian_jam }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Waktu Efektif (Menit)</label>
              <div class="col-sm-9">
                <input type="text" name="waktu_efektif" id="waktu_efektif"
                value="{{ $data->waktu_efektif }}" class="form-control" readonly>
              </div>
              <label class="col-sm-3 col-form-label">Kebutuhan Pegawai</label>
              <div class="col-sm-9">
                <input type="text" name="kebutuhan_pegawai" id="kebutuhan_pegawai"
                value="{{ $data->kebutuhan_pegawai }}" class="form-control" readonly>
              </div>
            </div>
          {{-- <?php endforeach; ?> --}}
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="#" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>

@endsection
