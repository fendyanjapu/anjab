<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Analisa Jabatan</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets_admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/assets_admin/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets_admin/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/assets_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets_admin/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('asset') }}/assets_admin/images/favicon.png" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  </head>
  <body>
    <div class="container-scroller">
		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="text-dark font-weight-bold mb-2" href="{{ route('admin') }}">
                  <img src="{{ asset('asset/assets_admin/images/HOME_.png') }}"
                  style="width:120px"></a><br>
            </div>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown d-lg-flex d-none">
                  <h5 class="text-dark font-weight-bold mb-2">
                       {{ session('nama_sopd') }}
                  </h5>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">

                  <a href="{{ route('logout') }}"
                    class="btn btn-inverse-primary btn-sm">Logout</a>
                </li>
              </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
    </div>
    <!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
          @yield('isi')
				</div>
			</div>
		</div>
		<!-- content-wrapper ends -->
		<!-- partial:partials/_footer.html -->
				<footer class="footer">
          <div class="footer-wrap">
              <div class="w-100 clearfix">
                <span class="d-block text-center text-sm-left d-sm-inline-block">
                  Copyright © 2020</span>
              </div>
          </div>
        </footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
    <!-- base:js -->
    <!-- <script src="{{ asset('asset') }}/assets_admin/vendors/base/vendor.bundle.base.js"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('asset') }}/assets_admin/js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ asset('asset') }}/assets_admin/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="{{ asset('asset') }}/assets_admin/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset('asset') }}/assets_admin/js/file-upload.js"></script>
    <script src="{{ asset('asset') }}/assets_admin/js/typeahead.js"></script>
    <script src="{{ asset('asset') }}/assets_admin/js/select2.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>
@include('sweetalert::alert')
