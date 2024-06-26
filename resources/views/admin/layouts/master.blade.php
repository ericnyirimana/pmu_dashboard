<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset("/images/favicon.ico")}}">

        <!-- Adminnox css -->
        <link rel="stylesheet" href="{{ asset("/adminox/assets/css/bootstrap.min.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/adminox/assets/css/icons.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/adminox/assets/css/metismenu.min.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/adminox/assets/css/style.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/plugins/switchery/switchery.min.css") }}" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset("/plugins/timepicker/bootstrap-timepicker.min.css") }}" type="text/css">
        <link rel="stylesheet" href="{{ asset("/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="{{ asset("/plugins/jquery-ui/jquery-ui.min.css") }}" type="text/css">

        <!-- APP overwrite css -->
        <link href="{{ asset("/css/app.css")}}" rel="stylesheet" type="text/css" />

        <script src="{{ asset("/adminox/assets/js/modernizr.min.js")}}"></script>

        @stack('styles')
        @stack('calendar-styles')
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

        @stack('modal')
        <!-- END wrapper -->

        <!-- jQuery  -->

        <script src="{{ asset("/adminox/assets/js/jquery.min.js")}}" type="text/javascript" ></script>
        <script src="{{ asset("/adminox/assets/js/popper.min.js")}}" type="text/javascript" ></script>
        <script src="{{ asset("/adminox/assets/js/bootstrap.min.js")}}" type="text/javascript" ></script>
        <script src="{{ asset("/adminox/assets/js/metisMenu.min.js")}}" type="text/javascript" ></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript" ></script>
        <script src="{{ asset("/adminox/assets/js/waves.js")}}" type="text/javascript" ></script>
        <script src="{{ asset("/adminox/assets/js/jquery.slimscroll.js")}}" type="text/javascript" ></script>
        <script src="{{ asset("/adminox/assets/pages/jquery.scrollbar.js")}}" type="text/javascript"></script>
        <script src="{{ asset("/plugins/switchery/switchery.min.js") }}" type="text/javascript" ></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js" type="text/javascript" ></script>
        <script src="{{ asset("/plugins/timepicker/bootstrap-timepicker.js") }}" type="text/javascript" ></script>
        <script src="{{ asset("/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}" type="text/javascript" ></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" type="text/javascript" ></script>
        <script src="{{ asset("/plugins/jquery-ui/jquery-ui.min.js") }}" type="text/javascript" ></script>
        <script src="{{ asset("/plugins/jquery-mask-plugin/dist/jquery.mask.min.js") }}" type="text/javascript" ></script>

        @stack('scripts')
        @stack('calendar-scripts')
        <!-- App js -->
        <script src="{{ asset("/adminox/assets/js/jquery.core.js")}}"></script>
        <script src="{{ asset("/adminox/assets/js/jquery.app.js")}}"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAKnCHsLNc5miuhThF26x7aHb0KXleER4&libraries=places"></script>

    </body>
</html>
