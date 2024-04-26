<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - ANJAB Barito Kuala</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="<?php echo base_url() ?>assets/css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">


  <!-- Masthead -->
  <header class="masthead page-section" id="beranda">
  <div class="nav-cont"><div class="nav-top nav-jew"><a class="nav-top1" href="/"><i class="fa fa-info-circle" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> PERTANYAAN</a><a class="nav-top3 nav-top5" href="https://apps.baritokualakab.go.id/anjab" ><i class="fa fa-long-arrow-left" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> KEMBALI KE HOMEPAGE</a></div></div>
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
            <img href="/" class="logo-agung" src="https://apps.baritokualakab.go.id/anjab/assets/img/logo.png" width="250">
          <div class="logen-text">Selamat Datang <br> di Website ANJAB Barito Kuala</div>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <form action="<?php echo base_url('login/signin') ?>" method="post">
            <div class="collapse show input-group" id="collapseAdvanceSearch">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" id="username" placeholder="Nama Pengguna">
                            </div>
                            <div class="form-group">
                              <input type="password" name="password" class="form-control" id="password" placeholder="Kata Kunci">
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-12">
                          <button type="submit" name="button"
                          class="btn btn-primary btn-xl btn-log js-scroll-trigger"><i class="fa fa-sign-in" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> Masuk</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </header>

  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2020 - Bidang Layanan e-Government Diskominfo Barito Kuala</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

</body>

</html>
