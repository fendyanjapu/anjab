<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Beranda - ANJAB Barito Kuala</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="{{ asset('asset') }}/assets/css/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="{{ asset('asset') }}/assets/css/creative.min.css" rel="stylesheet">

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
            <a class="nav-link js-scroll-trigger" href="">Pengaturan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}">Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead page-section" id="menu">
        <div class="nav-cont"><div class="nav-top nav-jew">
          <a class="nav-top1 nav-top-bg" href="{{ route('logout') }}">
            <i class="fa fa-sign-out" style="font-size:20px;margin-right:3px;" aria-hidden="true">
            </i> LOGOUT</a>
          </div></div>
    <div class="container h-100">
              <?php if (Session::get('level')==1): ?>
                <div class="col-lg-3 col-md-6 text-center" style="float: top">
                  <div class="mt-5">
                    <a href="#" class="faqs">
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
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-users text-primary mb-2"></i>
                    <div class="text-tot">Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-server text-primary mb-2"></i>
                    <div class="text-tot">Ikhtisar Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-tag text-primary mb-2"></i>
                    <div class="text-tot">Kualifikasi Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-list-alt text-primary mb-2"></i>
                    <div class="text-tot">Tugas Pokok (ABK)</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-table text-primary mb-2"></i>
                    <div class="text-tot">Hasil Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-cog text-primary mb-2"></i>
                    <div class="text-tot">Bahan Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-laptop text-primary mb-2"></i>
                    <div class="text-tot">Perangkat Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-sitemap text-primary mb-2"></i>
                    <div class="text-tot">Tanggung Jawab</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-user-circle text-primary mb-2"></i>
                    <div class="text-tot">Wewenang</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-handshake text-primary mb-2"></i>
                    <div class="text-tot">Korelasi Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-home text-primary mb-2"></i>
                    <div class="text-tot">Kondisi Lingkungan Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-exclamation-triangle text-primary mb-2"></i>
                    <div class="text-tot">Risiko Bahaya</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-check text-primary mb-2"></i>
                    <div class="text-tot">Syarat Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-trophy text-primary mb-2"></i>
                    <div class="text-tot">Prestasi Kerja</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
                    <i class="fas fa-3x fa-list-ol text-primary mb-2"></i>
                    <div class="text-tot">Kelas Jabatan</div>
                    <p class="text-muted mb-0"></p>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                  <div class="mt-5">
                    <a href="#" class="faqs">
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
  <script src="{{ asset('asset') }}/assets/js/jquery.min.js"></script>
  <script src="{{ asset('asset') }}/assets/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('asset') }}/assets/js/jquery.easing.min.js"></script>
  <script src="{{ asset('asset') }}/assets/js/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('asset') }}/assets/js/creative.min.js"></script>

  </body>

  </html>
