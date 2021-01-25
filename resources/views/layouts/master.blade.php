<?php


// $menu = \DB::table('menu_master as mm')
//             ->join('menu_child as mc','mm.menu_id','mc.menu_id', 'left outer')
//             ->join('group_menu_items as gmi', 'gmi.menuchild_id', 'mc.menuchild_id', 'left outer')
//             ->join('user_in_group as uig', 'uig.group_id', 'gmi.group_id', 'left outer')
//             ->where('uig.user_id', Auth::user()->user_id)
//             ->where('mm.isactive', '1')
//             ->where('mc.isactive', '1')
//             ->select('mm.menu_name', 'mc.child_name')
//             ->orderBy('mm.serial_order')
//             ->orderBy('mc.serial_order')
//             ->get();
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content='{{csrf_token()}}' name='csrf-token' />
    <title>VOPD</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png') }}">
    @yield('css')
    <link href="{{ asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{asset('assets/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href=" {{asset('assets/css/style.css') }}" rel="stylesheet">
    <link href=" {{asset('assets/css/app.css') }}" rel="stylesheet">
    <?php

    // <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png') }}">
    // <!-- Pignose Calender -->
    // <link href="{{asset('assets/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    // <!-- Chartist -->
    // <link rel="stylesheet" href="{{asset('assets/plugins/chartist/css/chartist.min.css') }}">
    // <link rel="stylesheet" href="{{asset('assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">


    // <!-- Custom Stylesheet -->
    // <link href=" {{asset('assets/css/style.css') }}" rel="stylesheet">

    ?>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        

        @include('layouts.nav_header')
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
            
        @include('layouts.header')

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
       
        
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">


            @yield('content')

           
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <!-- <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p> -->
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
  <?php
  /*
    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/gleek.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script>

    <!-- Chartjs -->
    <script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Circle progress -->
    <script src="{{asset('assets/plugins/circle-progress/circle-progress.min.js')}}"></script>
    <!-- Datamap -->
    <script src="{{asset('assets/plugins/d3v3/index.js')}}"></script>
    <script src="{{asset('assets/plugins/topojson/topojson.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datamaps/datamaps.world.min.js')}}"></script>
    <!-- Morrisjs -->
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <!-- Pignose Calender -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script>
    <!-- ChartistJS -->
    <script src="{{asset('assets/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{asset('assets/lugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{asset('assets/plugins/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/plugins/validation/jquery.validate-init.js')}}"></script>

    
    <script src="{{asset('assets/js/dashboard/dashboard-1.js') }}"></script>
    */
    ?>
 
    
    
    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/gleek.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script>

    <script src="{{ asset('assets/./plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/./plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/./plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    <!-- Sweet Alert -->
   
    <script src="{{asset('assets/plugins/sweetalert/js/sweetalert.min.js')}}"></script>
    <!-- Chartjs -->
    {{-- <script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script> --}}
    <!-- Circle progress -->
    {{-- <script src="{{asset('assets/plugins/circle-progress/circle-progress.min.js')}}"></script> --}}
    <!-- Datamap -->
    {{-- <script src="{{asset('assets/plugins/d3v3/index.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/topojson/topojson.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/datamaps/datamaps.world.min.js')}}"></script> --}}
    <!-- Morrisjs -->
    {{-- <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script> --}}
    <!-- Pignose Calender -->
    {{-- <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script> --}}
    <!-- ChartistJS -->
    {{-- <script src="{{asset('assets/plugins/chartist/js/chartist.min.js') }}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script> --}}

    {{-- <script src="{{asset('assets/js/dashboard/dashboard-1.js') }}"></script> --}}


    @yield('script')

    <script src="{{asset('assets/js/app.js')}}"></script>


</body>

</html>