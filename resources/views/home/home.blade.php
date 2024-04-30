<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ANJAB BARITO KUALA</title>

  <!-- Font Awesome Icons -->
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="{{ asset('asset')}}/assets/css/creative.min.css" rel="stylesheet">
  <script src="{{ asset('asset')}}/assets/vendor/jquery/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $('#id_sopd').on('change', function(){
        var id_sopd = $(this).val();
      $.ajax({
        type   : "GET",
        url    : '/jabatan/' + id_sopd,
        data   : {
            '_token': '{{ csrf_token() }}', // Tambahkan token CSRF untuk keamanan
            // 'id_sopd': id_sopd
        },
        dataType: 'json',
        cache  : false,

        success: function(data){
            if(data){
                $('#id_jabatan').empty();
                $('#id_jabatan').append('<option value="">JABATAN</option>');
                data.sort();
                $.each(data, function(key, jabatan){
                    $('select[name="id_jabatan"]').append(
                        '<option value="' + key + '">' +
                        jabatan + '</option>'
                    );
                });
            }
            else{
                $('#id_jabatan').empty();
            }
            // var jabatanData = JSON.parse(data);
            // // Mengambil nilai properti 'jabatan' dari objek jabatanData
            // var jabatan = jabatanData.jabatan;
            // // Menetapkan nilai jabatan ke dalam elemen dengan ID 'id_jabatan'
            // $('#id_jabatan').val(jabatan);
        }
      });
    });
    // $('#cari').click(function(){
    //   var id_sopd     = $('#id_sopd').val();
    //   var id_jabatan  = $('#id_jabatan').val();
    //   $.ajax({
    //     type   : "POST",
    //     url    : "",
    //     data   : "id_sopd="+id_sopd+"&id_jabatan="+id_jabatan,
    //     cache  : false,
    //     success: function(hasil){
    //       $('#hasil').html(hasil);
    //     }
    //   });
    // });
  });
  </script>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">ANJAB BATOLA</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact"><i class="fa fa-question-circle" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> Pertanyaan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href=""><i class="fa fa-user-circle" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> Masuk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead -->
  <header class="masthead page-section" id="beranda">
        <div class="nav-cont"><div class="nav-top"><a class="nav-top1" href="/"><i class="fa fa-info-circle" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> PERTANYAAN</a><a class="nav-top3" href="https://apps.baritokualakab.go.id/anjab/login" ><i class="fa fa-user-circle" style="font-size:20px;margin-right:3px;" aria-hidden="true"></i> MASUK</a></div></div>
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
            <img href="{{ asset('asset/assets/img/logo.png')}}" class="logo-agung" src="{{ asset('asset/assets/img/logo.png')}}" width="250">
          <h3 class="text-jud">ANALISIS JABATAN</h3> <br>
            <h3 class="text-judu">KABUPATEN BARITO KUALA</h3>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <form action="" method="post">

            <div class="collapse show input-group" id="collapseAdvanceSearch">
                <div class="card card-body card-no-border">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="text-white" for="search-bentuk"></label>
                                <select name="id_sopd" id="id_sopd"
                                class="form-control">
                                    <option value="">SOPD</option>
                                      @foreach ($q_sopd as $key)
                                            <option id="id_sopd" value="{{ $key->id_sopd }}">{{ $key->nama_sopd }}</option>
                                      @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="text-white" for="search-tahun"></label>
                                <select name="id_jabatan" id="id_jabatan"
                                class="form-control">
                                    <option value="">JABATAN</option>
                                    @foreach ($q_jabatan as $key)
                                        <option id="id_jabatan" value="{{ $key->id_jabatan }}">{{ $key->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         <!-- <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="text-white" for="search-tahun">Jenis Jabatan</label>
                                <select name="filter_tahun" id="search-bentuk" class="form-control">
                                    <option value="">Jenis Jabatan</option>
                                            <option value="2">Struktural</option>
                                            <option value="3">Fungsional</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label class="text-white" for="search-judul">Kata Kunci Pencarian</label>
                                <input type="text" name="filter_judul" class="form-control" id="search-judul" placeholder="Kata Kunci Pencarian">
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-12">
                        <a href="#konten" class="btn btn-primary btn-xl js-scroll-trigger" id="cari">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </header>

  <!-- About Section -->
  <section class="page-section bg-primary">
    <div class="container" id="konten">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="" id="hasil">

          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2020 - Bidang Layanan e-Government Diskominfo Barito Kuala</div>
    </div>
  </footer>

</body>

</html>
