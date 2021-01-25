<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VOPD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta content='{{csrf_token()}}' name='csrf-token' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet"
    href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
  <link href="{{asset('assets/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
  @yield('css')

  <!-- Custom Stylesheet -->
  <link href=" {{asset('assets/css/app.css') }}" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  {{-- <div id="preloader">
    <div id="loader"></div>
  </div> --}}
 <!--  <div id="overlay">
    <div class="loader">Loading...</div>
  </div> -->

  <div class="wrapper" >
    
    <!--**********************************
            Nav header start
        ***********************************-->
<nav class="main-header navbar navbar-expand navbar-lightblue navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item bg-lightblue color-palette">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block bg-lightblue color-palette">
        <a href="#" class="nav-link">CDR REPORT</a>
      </li>
    </ul>

  </nav>

   
    <!--**********************************
            Nav header end
        ***********************************-->


    <!--**********************************
            Sidebar start
        ***********************************-->
   <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/ArmmanLogo.jpg') }}" alt="AdminLTE Logo" style="width:98%";>
    
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         <!--  <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image"> -->
         <span class="bg-light color-palette">VOPD IMAGE</span>
        </div>
      
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CDR</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page</p>
                </a>
              </li>
            </ul>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!--**********************************
            Sidebar end
        ***********************************-->


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-wrapper" style="min-height: 36px;">

      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      @yield('content')


      <!-- #/ container -->
    </div>
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->

  
    <!--**********************************
            Footer end
        ***********************************-->

      </div>
    <script>
      var BASE_URL = "<?php echo url('/'); ?>";
    </script>
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- ChartJS -->
    <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('assets/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
  
    @yield('script')

    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
      jQuery(document).ready(function() {
 
          jQuery('#overlay').fadeOut();

      });
      </script>
</body>

</html>