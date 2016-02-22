<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#573e81">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#573e81">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#573e81">

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>--}}
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{--<link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">--}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body id="app-layout">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a title="Department of Computer Science - ACERC" class="navbar-brand" href="{{ url('/') }}" style="padding: 6.5px 15px">
                <img src="{{ asset('/images/static/logo.png') }}" alt="ACERC" class="img" style="height: 50px;">
            </a>

            <a class="navbar-brand" href="{{ url('/') }}">
                ACERC
            </a>
        </div>

    </div>
</nav>

    @yield('content')
            <!-- JavaScripts -->
    {{--<script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>--}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

</body>
</html>
