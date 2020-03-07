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
        <link rel="shortcut icon" href="{{ asset("/images/favicon2.ico")}}">

        <!-- Adminnox css -->
        <link rel="stylesheet" href="{{ asset("/adminox/assets/css/bootstrap.min.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/adminox/assets/css/icons.css")}}" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>

        <!-- APP overwrite css -->
        <link href="{{ asset("/css/web.css")}}" rel="stylesheet" type="text/css" />

        <script type="text/javascript">var _iub = _iub || {}; _iub.cons_instructions = _iub.cons_instructions || []; _iub.cons_instructions.push(["init", {api_key: "UkPXzwj5tK69op8iAFJrl0yuRli7mltL"}]);</script><script type="text/javascript" src="https://cdn.iubenda.com/cons/iubenda_cons.js" async></script>
        @stack('styles')

    </head>


    <body>


    @yield('content')

        <!-- jQuery  -->

        <script src="{{ asset("/adminox/assets/js/jquery.min.js")}}"></script>
        <script src="{{ asset("/adminox/assets/js/bootstrap.min.js")}}"></script>
        <script src="{{ asset("/adminox/assets/js/jquery.slimscroll.js")}}"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        @stack('scripts')


    </body>
</html>
