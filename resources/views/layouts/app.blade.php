<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#333333">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#333333">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#333333">

    <title>@yield('title') - Department of Computer Science, ACERC</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>--}}
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{--<link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">--}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    {{ Html::style('/css/fa/css/font-awesome.min.css') }}
    @yield('styles')
</head>
<body id="app-layout">

@include('partials.navbar')

@if(Session::has('notification'))
    <div class="container">
    <div class="alert alert-{{ Session::has('type') ? Session::get('type') : 'info' }} col-md-10 text-center notification" style="position: absolute;z-index:100;">
        {{ Session::get('notification') }}
    </div>
    </div>
@endif

    @yield('content')

@include('partials.footer')
            <!-- JavaScripts -->
    {{--<script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/app.js"></script>--}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    <script src="{{ elixir('js/all.js') }}"></script>
    @yield('scripts')
</body>
</html>
