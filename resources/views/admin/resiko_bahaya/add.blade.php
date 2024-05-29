@extends('admin.template')
@section('isi')

<script>
	$(document).ready(function(){
		$('#jumlah_kolom').change(function(){
			var jml = $('#jumlah_kolom').val();
			$.ajax({
				type   : "POST",
				url    : "/admin/resiko-bahaya/jumlah_kolom",
				data   : {
                    '_token' : '{{ csrf_token() }}',
                    'jml' : jml
                },
                dataType : 'json',
				cache  : false,
				success: function(response){
					var html = '';
                    var counter = 1;
                    var jumlah = response.result;

                    for (var i = 0; i < jumlah; i++) {
                        html += '<div class="form-group row">' +
                            '<label class="col-sm-3 col-form-label">Nama Resiko ' + '</label>' +
                            '<div class="col-sm-9">' +
                                '<input type="text" name="nama_resiko[]' + '" class="form-control" value="">' +
                            '</div>' +
                        '</div>';
                        html += '<div class="form-group row border-bottom">' +
                                '<label class="col-sm-3 col-form-label">Penyebab ' + '</label>' +
                                '<div class="col-sm-9">' +
                                    '<input type="text" name="penyebab[]' + '" class="form-control" value="">' +
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
        Resiko Bahaya</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="{{ route('ResikoBahaya.save') }}">
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
                <option value="10">10</option>
              </select>
            </div>
          </div>
          <div id="kolom">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Resiko</label>
              <div class="col-sm-9">
                <input type="text" name="nama_resiko" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Penyebab</label>
              <div class="col-sm-9">
                <input type="text" name="penyebab" class="form-control">
              </div>
            </div>
          </div>
          <center>
            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            <a href="{{ route('ResikoBahaya.index') }}" class="btn btn-light" onclick="self.history.back()">Batal</a>
          </center>
        </form>
    </div>
  </div>
</div>

@endsection
