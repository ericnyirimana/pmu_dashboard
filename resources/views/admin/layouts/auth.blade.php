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
        <link rel="shortcut icon" href="{{ asset("/admin/assets/images/favicon.ico")}}">

        <!-- C3 charts css -->
        <link href="{{ asset("/plugins/c3/c3.min.css")}}" rel="stylesheet" type="text/css" />

        <!-- Adminnox css -->
        <link href="{{ asset("/admin/assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/admin/assets/css/icons.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/admin/assets/css/metismenu.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/admin/assets/css/style.css")}}" rel="stylesheet" type="text/css" />

        <!-- APP overwrite css -->
        <link href="{{ asset("/css/app.css")}}" rel="stylesheet" type="text/css" />

        <script src="{{ asset("/admin/assets/js/modernizr.min.js")}}"></script>

        @stack('styles')

    </head>


    <body class="bg-accpunt-pages">

        @yield('content')

        <!-- jQuery  -->

        <script src="{{ asset("/admin/assets/js/jquery.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/popper.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/bootstrap.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/metisMenu.min.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/waves.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/jquery.slimscroll.js")}}"></script>


        <!-- App js -->
        <script src="{{ asset("/admin/assets/js/jquery.core.js")}}"></script>
        <script src="{{ asset("/admin/assets/js/jquery.app.js")}}"></script>

        @stack('scripts')

    </body>
</html>
