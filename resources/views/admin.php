<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Beranda - ANJAB Barito Kuala</title>

  <!-- Font Awesome Icons -->
  <link href="<?php echo base_url() ?>assets/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="<?php echo base_url() ?>assets/css/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="<?php echo base_url() ?>assets/css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">ANJAB Barito Kuala</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">Panduan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="<?php echo base_url('pengaturan') ?>">Pengaturan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="<?php echo base_url('login/logout') ?>">Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead page-section" id="menu">
        <div class="nav-cont"><div class="nav-top nav-jew">
          <a class="nav-top1 nav-top-bg" href="<?php echo base_url('login/logout') ?>">
            <i class="fa fa-sign-out" style="font-size:20px;margin-right:3px;" aria-hidden="true">
            </i> LOGOUT</a>
          </div></div>
    <div class="container h-100">
              <?php if ($this->session->userdata('level')==1): ?>
                <div class="col-lg-3 col-md-6 text-center" style="float: top">
                  <div class="mt-5">
                    <a href="<?php echo base_url('jabatan') ?>" class="faqs">
                    <i class="fas fa-3x fa-users text-primary mb-2"></i>
                    <div class="text-tot">Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
              <?php else: ?>
                <div class="row h-100 align-items-center justify-content-center text-center">
                   <div class="container">
                      <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('jabatan_sopd') ?>" class="faqs">
                    <i class="fas fa-3x fa-users text-primary mb-2"></i>
                    <div class="text-tot">Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('iktisar') ?>" class="faqs">
                    <i class="fas fa-3x fa-server text-primary mb-2"></i>
                    <div class="text-tot">Ikhtisar Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('kualifikasi_jabatan') ?>" class="faqs">
                    <i class="fas fa-3x fa-tag text-primary mb-2"></i>
                    <div class="text-tot">Kualifikasi Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('tugas_pokok') ?>" class="faqs">
                    <i class="fas fa-3x fa-list-alt text-primary mb-2"></i>
                    <div class="text-tot">Tugas Pokok (ABK)</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('hasil_kerja') ?>" class="faqs">
                    <i class="fas fa-3x fa-table text-primary mb-2"></i>
                    <div class="text-tot">Hasil Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('bahan_kerja') ?>" class="faqs">
                    <i class="fas fa-3x fa-cog text-primary mb-2"></i>
                    <div class="text-tot">Bahan Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('perangkat_kerja') ?>" class="faqs">
                    <i class="fas fa-3x fa-laptop text-primary mb-2"></i>
                    <div class="text-tot">Perangkat Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('tanggung_jawab') ?>" class="faqs">
                    <i class="fas fa-3x fa-sitemap text-primary mb-2"></i>
                    <div class="text-tot">Tanggung Jawab</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('wewenang') ?>" class="faqs">
                    <i class="fas fa-3x fa-user-circle text-primary mb-2"></i>
                    <div class="text-tot">Wewenang</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('korelasi_jabatan') ?>" class="faqs">
                    <i class="fas fa-3x fa-handshake text-primary mb-2"></i>
                    <div class="text-tot">Korelasi Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('kondisi_lingkungan_kerja') ?>" class="faqs">
                    <i class="fas fa-3x fa-home text-primary mb-2"></i>
                    <div class="text-tot">Kondisi Lingkungan Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('risiko_bahaya') ?>" class="faqs">
                    <i class="fas fa-3x fa-exclamation-triangle text-primary mb-2"></i>
                    <div class="text-tot">Risiko Bahaya</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('syarat_jabatan') ?>" class="faqs">
                    <i class="fas fa-3x fa-check text-primary mb-2"></i>
                    <div class="text-tot">Syarat Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('prestasi_kerja_yang_diharapkan') ?>" class="faqs">
                    <i class="fas fa-3x fa-trophy text-primary mb-2"></i>
                    <div class="text-tot">Prestasi Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('kelas_jabatan') ?>" class="faqs">
                    <i class="fas fa-3x fa-list-ol text-primary mb-2"></i>
                    <div class="text-tot">Kelas Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="<?php echo base_url('pengaturan') ?>" class="faqs">
                    <i class="fas fa-3x fa-gear text-primary mb-2"></i>
                    <div class="text-tot">Pengaturan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <?php endif; ?>

  </header>
  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2020 - Bidang Layanan e-Government Diskominfo Barito Kuala</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/jquery.easing.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="<?php echo base_url() ?>assets/js/creative.min.js"></script>

  </body>

  </html>
