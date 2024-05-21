@extends('admin.template')
@section('isi')
<script>

	$(document).ready(function(){
		$('#jumlah_kolom').on('change',function(){
			var jml = $('#jumlah_kolom').val();
			$.ajax({
				type   : "POST",
				url    : '/admin/hasil-kerja/jumlah_kolom',
				data   : {
                    '_token': '{{ csrf_token() }}',
                    'jml': jml
                },
                dataType: 'json',
				cache  : false,
				success: function(response){
                    var html = '';
                    var counter = 1;
                    var jumlah = response.result;

                    for (var i = 0; i < jumlah; i++) {
                        html += '<div class="form-group row border-bottom">' +
                            '<label class="col-sm-3 col-form-label">Hasil Kerja ' + '</label>' +
                            '<div class="col-sm-9">' +
                                '<input type="text" name="hasil[]' + '" class="form-control" value="">' +
                            '</div>' +
                        '</div>';
                    }

                    $('#kolom').html(html);
                }
			});
		});
	});
</script>
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
        action="{{ route('hasilKerja.save') }}">
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
            <label class="col-sm-3 col-form-label">Jumlah</label>
            <div class="col-sm-9">
              <select name="jumlah_kolom" id="jumlah_kolom" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
              </select>
            </div>
          </div>
          <div id="kolom">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hasil Kerja</label>
              <div class="col-sm-9">
                <input type="text" name="hasil" class="form-control">
              </div>
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
