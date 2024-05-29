@extends('admin.template')
@section('isi')
<center>
  <div class="col-md-7">
    <div class="card-body">
      <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
        Syarat Jabatan</button>
        <br><br>
    </div>
  </div>
</center>
<div class="col-md-9 grid-margin stretch-card"
style="position: relative;margin: auto;left:0;right:0;top:0; bottom:0;">
  <div class="card">
    <div class="card-body">
        <form class="forms-sample" method="post"
        action="{{ route('SyaratJabatan.update', $data->id) }}">
        @csrf
        @method('PUT')
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select class="js-example-basic-single w-100" name="id_jabatan_sopd" class="form-control">
                  <option value=""></option>
                  @foreach ($jsopd as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $data->id_jabatan_sopd ? 'selected' : ''}}>
                          {{ $item->jabatan_nama }}
                          @if ($item->atasan_id)
                              | atasan: {{ $item->atasan_nama }}
                          @endif
                  </option>
                  @endforeach
                </select>
              </div>
              <label class="col-sm-3 col-form-label">Keterampilan Kerja</label>
              <div class="col-sm-9">
                <input type="text" name="keterampilan_kerja" value="{{ $data->keterampilan_kerja }}" class="form-control">
              </div>

              <label class="col-sm-3 col-form-label">Bakat Kerja</label>
              <div class="col-sm-9 border-top">
                      <div class="row">
                          <div class="col md-6">
                              <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" name="bakat_kerja[]"
                                  value="Intelegensia"
                                  class="form-check-input"
                                  @if(in_array("Intelegensia", $bk)) checked @endif>
                                  Intelegensia
                                  </label>
                              </div>

                              <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" name="bakat_kerja[]" value="Bakat Verbal" class="form-check-input"
                                  @if(in_array("Bakat Verbal", $bk)) checked @endif>
                                  Bakat Verbal
                                  </label>
                              </div>
                              <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" name="bakat_kerja[]" value="Bakat Numerik" class="form-check-input"
                                  @if(in_array("Bakat Numerik", $bk)) checked @endif>
                                  Bakat Numerik
                                  </label>
                              </div>
                              <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" name="bakat_kerja[]" value="Bakat Pandang Ruang" class="form-check-input"
                                  @if(in_array("Bakat Pandang Ruang", $bk)) checked @endif>
                                  Bakat Pandang Ruang
                                  </label>
                              </div>
                              <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" name="bakat_kerja[]" value="Bakat Penerapan Bentuk" class="form-check-input"
                                  @if(in_array("Bakat Penerapan Bentuk", $bk)) checked @endif>
                                  Bakat Penerapan Bentuk
                                  </label>
                              </div>
                              <div class="form-check">
                                  <label class="form-check-label">
                                  <input type="checkbox" name="bakat_kerja[]" value="Bakat Ketelitian" class="form-check-input"
                                  @if(in_array("Bakat Ketelitian", $bk)) checked @endif>
                                  Bakat Ketelitian
                                  </label>
                              </div>
                          </div>
                          <div class="col-md-6">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" name="bakat_kerja[]" value="Koordinasi Motorik" class="form-check-input"
                                    @if(in_array("Koordinasi Motorik", $bk)) checked @endif>
                                    Koordinasi Motorik
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" name="bakat_kerja[]" value="Kecekatan Jari" class="form-check-input"
                                    @if(in_array("Kecekatan Jari", $bk)) checked @endif>
                                    Kecekatan Jari
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" name="bakat_kerja[]" value="Koordinasi Mata,Tangan,Kaki" class="form-check-input"
                                    @if(in_array("Koordinasi Mata,Tangan,Kaki", $bk)) checked @endif>
                                    Koordinasi Mata,Tangan,Kaki
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" name="bakat_kerja[]" value="Kemampuan Membedakan Warna" class="form-check-input"
                                    @if(in_array("Kemampuan Membedakan Warna", $bk)) checked @endif>
                                    Kemampuan Membedakan Warna
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" name="bakat_kerja[]" value="Kecekatan Tangan" class="form-check-input"
                                    @if(in_array("Kecekatan Tangan", $bk)) checked @endif>
                                    Kecekatan Tangan
                                  </label>
                                </div>
                          </div>
                      </div>
              </div>

              <label class="col-sm-3 col-form-label ">Temperamen kerja</label>
              <div class="col-sm-9 border-top">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Directing Control Planning (DCP)" class="form-check-input"
                              @if (in_array("Directing Control Planning (DCP)", $tk)) checked @endif>
                              Directing Control Planning (DCP)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Feeling Idea Fact (FIF)" class="form-check-input"
                              @if (in_array("Feeling Idea Fact (FIF)", $tk)) checked
                              @endif>
                              Feeling Idea Fact (FIF)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Influencing (INFLU)" class="form-check-input"
                              @if (in_array("Influencing (INFLU)", $tk)) checked
                              @endif>
                              Influencing (INFLU)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Sensory & Judgmental Creteria (SJC)" class="form-check-input"
                              @if (in_array("Sensory & Judgmental Creteria (SJC)", $tk)) checked
                              @endif>
                              Sensory & Judgmental Creteria (SJC)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Measurable and Verifiable Creteria (MVC)" class="form-check-input"
                              @if (in_array("Measurable and Verifiable Creteria (MVC)", $tk)) checked
                              @endif>
                              Measurable and Verifiable Creteria (MVC)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Dealing with People (DEPL)" class="form-check-input"
                              @if (in_array("Dealing with People (DEPL)", $tk)) checked
                              @endif>
                              Dealing with People (DEPL)
                              </label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Repetitive and Continuous (REPCON)" class="form-check-input"
                              @if (in_array("Repetitive and Continuous (REPCON)", $tk)) checked
                              @endif>
                              Repetitive and Continuous (REPCON)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Performing Under Stress (PUS)" class="form-check-input"
                              @if (in_array("Performing Under Stress (PUS)", $tk)) checked
                              @endif>
                              Performing Under Stress (PUS)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Set of Limits, Tolerance and Other Standart (STS)" class="form-check-input"
                              @if (in_array("Set of Limits, Tolerance and Other Standart (STS)", $tk)) checked
                              @endif>
                              Set of Limits, Tolerance and Other Standart (STS)
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="temperamen_kerja[]" value="Variety and Changing Conditions (VARCH)" class="form-check-input"
                              @if (in_array("Variety and Changing Conditions (VARCH)", $tk)) checked
                              @endif>
                              Variety and Changing Conditions (VARCH)
                              </label>
                          </div>
                      </div>
                  </div>
              </div>


              <label class="col-sm-3 col-form-label">Minat Kerja</label>
              <div class="col-sm-9 border-top">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Realistik" class="form-check-input"
                    @if (in_array("Realistik", $mk)) checked
                    @endif>
                    Realistik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Investigatif" class="form-check-input"
                    @if (in_array("Investigatif", $mk)) checked
                    @endif>
                    Investigatif
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Artistik" class="form-check-input"
                    @if (in_array("Artistik", $mk)) checked
                    @endif>
                    Artistik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Sosial" class="form-check-input"
                    @if (in_array("Sosial", $mk)) checked
                    @endif>
                    Sosial
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Kewirausahaan" class="form-check-input"
                    @if (in_array("Kewirausahaan", $mk)) checked
                    @endif>
                    Kewirausahaan
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Konvensional" class="form-check-input"
                    @if (in_array("Konvensional", $mk)) checked
                    @endif>
                    Konvensional
                  </label>
                </div>
              </div>

              <label class="col-sm-3 col-form-label">Upaya Fisik</label>
              <div class="col-sm-9 border-top">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Berdiri" class="form-check-input"
                              @if (in_array("Berdiri", $uf)) checked
                              @endif>
                              Berdiri
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Berjalan" class="form-check-input"
                              @if (in_array("Berjalan", $uf)) checked
                              @endif>
                              Berjalan
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Duduk" class="form-check-input"
                              @if (in_array("Duduk", $uf)) checked
                              @endif>
                              Duduk
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Mengangkat" class="form-check-input"
                              @if (in_array("Mengangkat", $uf)) checked
                              @endif>
                              Mengangkat
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Membawa" class="form-check-input"
                              @if (in_array("Membawa", $uf)) checked
                              @endif>
                              Membawa
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Mendorong" class="form-check-input"
                              @if (in_array("Mendorong", $uf)) checked
                              @endif>
                              Mendorong
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Menarik" class="form-check-input">
                              @if (in_array("Menarik", $uf)) checked
                              @endif>
                              Menarik
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Memanjat" class="form-check-input"
                              @if (in_array("Memanjat", $uf)) checked
                              @endif>
                              Memanjat
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Menyimpan imbangan/mengatur imbangan" class="form-check-input"
                              @if (in_array("Menyimpan imbangan/mengatur imbangan", $uf)) checked
                              @endif>
                              Menyimpan imbangan/mengatur imbangan
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Menunduk" class="form-check-input"
                              @if (in_array("Menunduk", $uf)) checked
                              @endif>
                              Menunduk
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Berlutut" class="form-check-input"
                              @if (in_array("Berlutut", $uf)) checked
                              @endif>
                              Berlutut
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Membungkuk" class="form-check-input"
                              @if (in_array("Membungkuk", $uf)) checked
                              @endif>
                              Membungkuk
                              </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label">
                              <input type="checkbox" name="upaya_fisik[]" value="Merangkak" class="form-check-input"
                              @if (in_array("Merangkak", $uf)) checked
                              @endif>
                              Merangkak
                              </label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Menjangkau" class="form-check-input"
                                @if (in_array("Menjangkau", $uf)) checked
                                @endif>
                                Menjangkau
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Memegang" class="form-check-input"
                                @if (in_array("Memegang", $uf)) checked
                                @endif>
                                Memegang
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Bekerja dengan jari" class="form-check-input"
                                @if (in_array("Bekerja dengan jari", $uf)) checked
                                @endif>
                                Bekerja dengan jari
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Meraba" class="form-check-input"
                                @if (in_array("Meraba", $uf)) checked
                                @endif>
                                Meraba
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Berbicara" class="form-check-input"
                                @if (in_array("Berbicara", $uf)) checked
                                @endif>
                                Berbicara
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Mendengar" class="form-check-input"
                                @if (in_array("Mendengar", $uf)) checked
                                @endif>
                                Mendengar
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Melihat" class="form-check-input"
                                @if (in_array("Melihat", $uf)) checked
                                @endif>
                                Melihat
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Ketajaman jarak jauh" class="form-check-input"
                                @if (in_array("Ketajaman jarak jauh", $uf)) checked
                                @endif>
                                Ketajaman jarak jauh
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Ketajaman jarak dekat" class="form-check-input"
                                @if (in_array("Ketajaman jarak dekat", $uf)) checked
                                @endif>
                                Ketajaman jarak dekat
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Pengamatan secara mendalam" class="form-check-input"
                                @if (in_array("Pengamatan secara mendalam", $uf)) checked
                                @endif>
                                Pengamatan secara mendalam
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Penyesuaian lensa mata" class="form-check-input"
                                @if (in_array("Penyesuaian lensa mata", $uf)) checked
                                @endif>
                                Penyesuaian lensa mata
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Melihat berbagai warna" class="form-check-input"
                                @if (in_array("Melihat berbagai warna", $uf)) checked
                                @endif>
                                Melihat berbagai warna
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="upaya_fisik[]" value="Luas" class="form-check-input"
                                @if (in_array("Luas", $uf)) checked
                                @endif>
                                Luas
                              </label>
                            </div>
                      </div>
                  </div>
              </div>
              <label class="col-sm-3 col-form-label font-weight-bold">Kondisi Fisik</label>
              <div class="col-sm-9">

              </div>
              <label class="col-sm-3 col-form-label">Jenis kelamin</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin"
                    value="Laki-laki"
                    {{ $data->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} >
                    Laki-laki
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin"
                    value="Perempuan"
                    {{$data->jenis_kelamin == 'Perempuan'? 'checked' : ''}}
                    >
                    Perempuan
                  </label>
                </div>
              </div>
              <label class="col-sm-3 col-form-label">Umur</label>
              <div class="col-sm-9">
                <input type="text" name="umur" value="{{ $data->umur }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Tinggi Badan</label>
              <div class="col-sm-9">
                <input type="text" name="tinggi_badan" value="{{ $data->tinggi_badan }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Berat Badan</label>
              <div class="col-sm-9">
                <input type="text" name="berat_badan" value="{{ $data->berat_badan }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Postur Badan</label>
              <div class="col-sm-9">
                <input type="text" name="postur_badan" value="{{ $data->postur_badan }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Penampilan</label>
              <div class="col-sm-9">
                <input type="text" name="penampilan" value="{{ $data->penampilan }}" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Fungsi Pekerjaan</label>
              <div class="col-sm-9">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Memasang mesin" class="form-check-input"
                                @if (in_array("Memasang mesin", $fp)) checked
                                @endif>
                                Memasang mesin
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengerjakan Persisi" class="form-check-input"
                                @if (in_array("Mengerjakan Persisi", $fp)) checked
                                @endif>
                                Mengerjakan Persisi
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menjalankan mengontrol mesin" class="form-check-input"
                                @if (in_array("Menjalankan mengontrol mesin", $fp)) checked
                                @endif>
                                Menjalankan mengontrol mesin
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengemudikan/menjalankan mesin" class="form-check-input"
                                @if (in_array("Mengemudikan/menjalankan mesin", $fp)) checked
                                @endif>
                                Mengemudikan/menjalankan mesin
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengerjakan benda dengan tangan atau perkakas" class="form-check-input"
                                @if (in_array("Mengerjakan benda dengan tangan atau perkakas", $fp)) checked
                                @endif>
                                Mengerjakan benda dengan tangan atau perkakas
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Melayani mesin" class="form-check-input"
                                @if (in_array("Melayani mesin", $fp)) checked
                                @endif>
                                Melayani mesin
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Memasukkan, mengeluarkan barang ke/dari mesin" class="form-check-input"
                                @if (in_array("Memasukkan, mengeluarkan barang ke/dari mesin", $fp)) checked
                                @endif>
                                Memasukkan, mengeluarkan barang ke/dari mesin
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Memegang" class="form-check-input"
                                @if (in_array("Memegang", $fp)) checked
                                @endif>
                                Memegang
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Memadukan data" class="form-check-input"
                                @if (in_array("Memadukan data", $fp)) checked
                                @endif>
                                Memadukan data
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengkoordinasi data" class="form-check-input"
                                @if (in_array("Mengkoordinasi data", $fp)) checked
                                @endif>
                                Mengkoordinasi data
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menganalisis data" class="form-check-input"
                                @if (in_array("Menganalisis data", $fp)) checked
                                @endif>
                                Menganalisis data
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menyusun data" class="form-check-input"
                                @if (in_array("Menyusun data", $fp)) checked
                                @endif>
                                Menyusun data
                              </label>
                            </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menghitung data" class="form-check-input"
                                @if (in_array("Menghitung data", $fp)) checked
                                @endif>
                                Menghitung data
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menyalin data" class="form-check-input"
                                @if (in_array("Menyalin data", $fp)) checked
                                @endif>
                                Menyalin data
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Membandingkan data" class="form-check-input"
                                @if (in_array("Membandingkan data", $fp)) checked
                                @endif>
                                Membandingkan data
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menasehati" class="form-check-input"
                                @if (in_array("Menasehati", $fp)) checked
                                @endif>
                                Menasehati
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Berunding" class="form-check-input"
                                @if (in_array("Berunding", $fp)) checked
                                @endif>
                                Berunding
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengajar" class="form-check-input"
                                @if (in_array("Mengajar", $fp)) checked
                                @endif>
                                Mengajar
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menyelia" class="form-check-input"
                                @if (in_array("Menyelia", $fp)) checked
                                @endif>
                                Menyelia
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menghibur" class="form-check-input"
                                @if (in_array("Menghibur", $fp)) checked
                                @endif>
                                Menghibur
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Mempengaruhi" class="form-check-input"
                                @if (in_array("Mempengaruhi", $fp)) checked
                                @endif>
                                Mempengaruhi
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Berbicara memberi tanda" class="form-check-input"
                                @if (in_array("Berbicara memberi tanda", $fp)) checked
                                @endif>
                                Berbicara memberi tanda
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Melayani orang" class="form-check-input"
                                @if (in_array("Melayani orang", $fp)) checked
                                @endif>
                                Melayani orang
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" name="fungsi_pekerjaan[]" value="Menerima instruksi" class="form-check-input"
                                @if (in_array("Menerima instruksi", $fp)) checked
                                @endif>
                                Menerima instruksi
                              </label>
                            </div>
                      </div>
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
