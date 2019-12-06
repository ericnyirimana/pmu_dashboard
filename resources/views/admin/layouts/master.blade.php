<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset("/images/favicon.ico")}}">

        <!-- Adminnox css -->
        <link rel="stylesheet" href="{{ asset("/admin/assets/css/bootstrap.min.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/admin/assets/css/icons.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/admin/assets/css/metismenu.min.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/admin/assets/css/style.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/plugins/switchery/switchery.min.css") }}" type="text/css">
        <link rel="stylesheet" href="{{ asset("/plugins/timepicker/bootstrap-timepicker.min.css") }}" type="text/css">
        <link rel="stylesheet" href="{{ asset("/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}" type="text/css">

        <!-- APP overwrite css -->
        <link href="{{ asset("/css/app.css")}}" rel="stylesheet" type="text/css" />

        <script src="{{ asset("/admin/assets/js/modernizr.min.js")}}"></script>

        @stack('styles')

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            @include('admin.layouts.topbar')
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layouts.sidebar')
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                  <div class="container-fluid">

                      @include('admin.layouts.crumber')

                      @yield('content')

                  </div> <!-- container -->


                </div> <!-- content -->

                <footer class="footer text-right">
                    @include('admin.layouts.footer')
                </footer>

            </div>


        </div>
        <!-- END wrapper -->

        <!-- jQuery  -->

        <script src="{{ asset("/admin/assets/js/jquery.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/popper.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/bootstrap.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/metisMenu.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/waves.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/jquery.slimscroll.js")}}"></script>
        <script src="{{ asset("/plugins/switchery/switchery.min.js") }}"></script>
        <script src="{{ asset("/plugins/timepicker/bootstrap-timepicker.js") }}"></script>
        <script src="{{ asset("/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}"></script>
        @stack('scripts')

        <!-- App js -->
        <script src="{{ asset("/admin/assets/js/jquery.core.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/jquery.app.js")}}"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLUUH3H4en_Be_lwXe91KvayRpTnWso50&libraries=places"></script>

    </body>
</html>
