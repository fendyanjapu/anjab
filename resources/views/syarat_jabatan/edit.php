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
        action="<?php echo base_url('syarat_jabatan/update') ?>">
          <?php foreach ($query->result() as $key): ?>
            <input type="hidden" name="id" value="<?php echo $key->id ?>">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <select class="js-example-basic-single w-100" name="id_jabatan_sopd">
                  <option value=""></option>
                  <?php foreach ($q_jabatan->result() as $var): ?>
                    <option value="<?php echo $var->id ?>" <?php if ($key->id_jabatan_sopd==$var->id): ?>
                      selected
                    <?php endif; ?>>
                      <?php echo $var->nama_jabatan ?>
                      <?php
                        $this->db->where('id_jabatan', $var->atasan);
                        $q = $this->db->get('jabatan');
                        foreach ($q->result() as $value) {
                          echo "| atasan: ";
                          echo $value->nama_jabatan;
                        }
                      ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <label class="col-sm-3 col-form-label">Keterampilan Kerja</label>
              <div class="col-sm-9">
                <input type="text" name="keterampilan_kerja" value="<?php echo $key->keterampilan_kerja ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Bakat Kerja</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Intelegensia" class="form-check-input">
                    Intelegensia
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Bakat Verbal" class="form-check-input">
                    Bakat Verbal
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Bakat Numerik" class="form-check-input">
                    Bakat Numerik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Bakat Pandang Ruang" class="form-check-input">
                    Bakat Pandang Ruang
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Bakat Penerapan Bentuk" class="form-check-input">
                    Bakat Penerapan Bentuk
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Bakat Ketelitian" class="form-check-input">
                    Bakat Ketelitian
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Koordinasi Motorik" class="form-check-input">
                    Koordinasi Motorik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Kecekatan Jari" class="form-check-input">
                    Kecekatan Jari
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Koordinasi Mata,Tangan,Kaki" class="form-check-input">
                    Koordinasi Mata,Tangan,Kaki
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Kemampuan Membedakan Warna" class="form-check-input">
                    Kemampuan Membedakan Warna
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="bakat_kerja[]" value="Kecekatan Tangan" class="form-check-input">
                    Kecekatan Tangan
                  </label>
                </div>
              </div>
              <label class="col-sm-3 col-form-label">Temperamen kerja</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Directing Control Planning (DCP)" class="form-check-input">
                    Directing Control Planning (DCP)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Feeling Idea Fact (FIF)" class="form-check-input">
                    Feeling Idea Fact (FIF)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Influencing (INFLU)" class="form-check-input">
                    Influencing (INFLU)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Sensory & Judgmental Creteria (SJC)" class="form-check-input">
                    Sensory & Judgmental Creteria (SJC)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Measurable and Verifiable Creteria (MVC)" class="form-check-input">
                    Measurable and Verifiable Creteria (MVC)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Dealing with People (DEPL)" class="form-check-input">
                    Dealing with People (DEPL)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Repetitive and Continuous (REPCON)" class="form-check-input">
                    Repetitive and Continuous (REPCON)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Performing Under Stress (PUS)" class="form-check-input">
                    Performing Under Stress (PUS)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Set of Limits, Tolerance and Other Standart (STS)" class="form-check-input">
                    Set of Limits, Tolerance and Other Standart (STS)
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="temperamen_kerja[]" value="Variety and Changing Conditions (VARCH)" class="form-check-input">
                    Variety and Changing Conditions (VARCH)
                  </label>
                </div>
              </div>
              <label class="col-sm-3 col-form-label">Minat Kerja</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Realistik" class="form-check-input">
                    Realistik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Investigatif" class="form-check-input">
                    Investigatif
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Artistik" class="form-check-input">
                    Artistik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Sosial" class="form-check-input">
                    Sosial
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Kewirausahaan" class="form-check-input">
                    Kewirausahaan
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="minat_kerja[]" value="Konvensional" class="form-check-input">
                    Konvensional
                  </label>
                </div>
              </div>
              <label class="col-sm-3 col-form-label">Upaya Fisik</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Berdiri" class="form-check-input">
                    Berdiri
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Berjalan" class="form-check-input">
                    Berjalan
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Duduk" class="form-check-input">
                    Duduk
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Mengangkat" class="form-check-input">
                    Mengangkat
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Membawa" class="form-check-input">
                    Membawa
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Mendorong" class="form-check-input">
                    Mendorong
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Menarik" class="form-check-input">
                    Menarik
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Memanjat" class="form-check-input">
                    Memanjat
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Menyimpan imbangan / mengatur imbangan" class="form-check-input">
                    Menyimpan imbangan / mengatur imbangan
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Menunduk" class="form-check-input">
                    Menunduk
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Berlutut" class="form-check-input">
                    Berlutut
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Membungkuk" class="form-check-input">
                    Membungkuk
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Merangkak" class="form-check-input">
                    Merangkak
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Menjangkau" class="form-check-input">
                    Menjangkau
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Memegang" class="form-check-input">
                    Memegang
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Bekerja dengan jari" class="form-check-input">
                    Bekerja dengan jari
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Meraba" class="form-check-input">
                    Meraba
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Berbicara" class="form-check-input">
                    Berbicara
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Mendengar" class="form-check-input">
                    Mendengar
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Melihat" class="form-check-input">
                    Melihat
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Ketajaman jarak jauh" class="form-check-input">
                    Ketajaman jarak jauh
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Ketajaman jarak dekat" class="form-check-input">
                    Ketajaman jarak dekat
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Pengamatan secara mendalam" class="form-check-input">
                    Pengamatan secara mendalam
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Penyesuaian lensa mata" class="form-check-input">
                    Penyesuaian lensa mata
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Melihat berbagai warna" class="form-check-input">
                    Melihat berbagai warna
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="upaya_fisik[]" value="Luas" class="form-check-input">
                    Luas
                  </label>
                </div>
              </div>
              <label class="col-sm-3 col-form-label">Kondisi Fisik</label>
              <div class="col-sm-9">

              </div>
              <label class="col-sm-3 col-form-label">Jenis kelamin</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin"
                    value="Laki-laki" <?php if ($key->jenis_kelamin=="Laki-laki"): ?>
                      checked
                    <?php endif; ?>>
                    Laki-laki
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin"
                    value="Perempuan" <?php if ($key->jenis_kelamin=="Perempuan"): ?>
                      checked
                    <?php endif; ?>>
                    Perempuan
                  </label>
                </div>
              </div>
              <label class="col-sm-3 col-form-label">Umur</label>
              <div class="col-sm-9">
                <input type="text" name="umur" value="<?php echo $key->umur ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Tinggi Badan</label>
              <div class="col-sm-9">
                <input type="text" name="tinggi_badan" value="<?php echo $key->tinggi_badan ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Berat Badan</label>
              <div class="col-sm-9">
                <input type="text" name="berat_badan" value="<?php echo $key->berat_badan ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Postur Badan</label>
              <div class="col-sm-9">
                <input type="text" name="postur_badan" value="<?php echo $key->postur_badan ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Penampilan</label>
              <div class="col-sm-9">
                <input type="text" name="penampilan" value="<?php echo $key->penampilan ?>" class="form-control">
              </div>
              <label class="col-sm-3 col-form-label">Fungsi Pekerjaan</label>
              <div class="col-sm-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Memasang mesin" class="form-check-input">
                    Memasang mesin
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengerjakan Persisi" class="form-check-input">
                    Mengerjakan Persisi
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menjalankan mengontrol mesin" class="form-check-input">
                    Menjalankan mengontrol mesin
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengemudikan/menjalankan mesin" class="form-check-input">
                    Mengemudikan/menjalankan mesin
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengerjakan benda dengan tangan atau perkakas" class="form-check-input">
                    Mengerjakan benda dengan tangan atau perkakas
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Melayani mesin" class="form-check-input">
                    Melayani mesin
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Memasukkan, mengeluarkan barang ke/dari mesin" class="form-check-input">
                    Memasukkan, mengeluarkan barang ke/dari mesin
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Memegang" class="form-check-input">
                    Memegang
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Memadukan data" class="form-check-input">
                    Memadukan data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengkoordinasi data" class="form-check-input">
                    Mengkoordinasi data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menganalisis data" class="form-check-input">
                    Menganalisis data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menyusun data" class="form-check-input">
                    Menyusun data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menghitung data" class="form-check-input">
                    Menghitung data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menyalin data" class="form-check-input">
                    Menyalin data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Membandingkan data" class="form-check-input">
                    Membandingkan data
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menasehati" class="form-check-input">
                    Menasehati
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Berunding" class="form-check-input">
                    Berunding
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Mengajar" class="form-check-input">
                    Mengajar
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menyelia" class="form-check-input">
                    Menyelia
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menghibur" class="form-check-input">
                    Menghibur
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Mempengaruhi" class="form-check-input">
                    Mempengaruhi
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Berbicara memberi tanda" class="form-check-input">
                    Berbicara memberi tanda
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Melayani orang" class="form-check-input">
                    Melayani orang
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="fungsi_pekerjaan[]" value="Menerima instruksi" class="form-check-input">
                    Menerima instruksi
                  </label>
                </div>
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
