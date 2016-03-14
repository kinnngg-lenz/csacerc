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

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title') - Department of Computer Science, ACERC</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>--}}
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{--<link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">--}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="//cdn.jsdelivr.net/emojione/2.1.1/assets/css/emojione.min.css"/>
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    {{ Html::style('/css/fa/css/font-awesome.min.css') }}
    @yield('styles')

    <script type="text/javascript">
        (function (e, t) { if (!t.__SV) { window.calq = t; var n = e.createElement("script"); n.type = "text/javascript"; n.src = "http" + ("https:" === e.location.protocol ? "s" : "") + '://api.calq.io/lib/js/core-1.0.js'; n.async = !0; var r = e.getElementsByTagName("script")[0]; r.parentNode.insertBefore(n, r); t.init = function (e, o) { if (t.writeKey) return; t.writeKey = e; t._initOptions = o; t._execQueue = []; m = "action.track action.trackSale action.trackHTMLLink action.trackPageView action.setGlobalProperty user.profile user.identify user.clear".split(" "); for (var n = 0; n < m.length; n++) { var f = function () { var r = m[n]; var s = function () { t._execQueue.push({ m: r, args: arguments }) }; var i = r.split("."); if (i.length == 2) { if (!t[i[0]]) { t[i[0]] = [] } t[i[0]][i[1]] = s } else { t[r] = s } }(); } }; t.__SV = 1 } })(document, window.calq || []);
        calq.init("ecfd57e437e7246ab60ed7f021868b1f");
        calq.action.trackPageView();   // [Optional] Leave if you want to automatically create a "Page View" action
    </script>

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
    <script src="//js.pusher.com/2.2/pusher.min.js"></script>
    <script src="//cdn.jsdelivr.net/emojione/2.1.1/lib/js/emojione.min.js"></script>
    <script src="{{ elixir('js/all.js') }}"></script>
    @yield('scripts')
</body>
</html>
