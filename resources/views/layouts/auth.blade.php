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
        <link rel="shortcut icon" href="{{ secure_asset("/images/favicon2.ico")}}">

        <!-- Adminnox css -->
        <link href="{{ secure_asset("/adminox/assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />

        <link href="{{ secure_asset("/adminox/assets/css/style.css")}}" rel="stylesheet" type="text/css" />

        <!-- APP overwrite css -->
        <link href="{{ secure_asset("/css/app.css")}}" rel="stylesheet" type="text/css" />

        @stack('styles')

    </head>


    <body class="bg-accpunt-pages">

        @yield('content')

        <!-- jQuery  -->

        <script src="{{ secure_asset("/adminox/assets/js/jquery.min.js")}}"></script>
        <script src="{{ secure_asset("/adminox/assets/js/bootstrap.min.js")}}"></script>


        @stack('scripts')

    </body>
</html>
