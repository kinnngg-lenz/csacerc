<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>--}}

    <!-- Styles -->
    {{--<link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">--}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
     <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    {{ Html::style('/css/fa/css/font-awesome.min.css') }}
    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
        .input-append .add-on, .input-prepend .add-on
        {
            display: inline-block;
            width: auto;
            height: 20px;
            min-width: 16px;
            padding: 4px 5px;
            font-size: 14px;
            font-weight: normal;
            line-height: 20px;
            text-align: center;
            text-shadow: 0 1px 0 #ffffff;
            background-color: #eeeeee;
            border: 1px solid #ccc;
        }
        .bootstrap-datetimepicker-widget ul
        {
            padding: 0px !important;
            padding: 5px;
        }
        .bootstrap-datetimepicker-widget.dropdown-menu li > a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 20px;
            color: #0081c2;
            white-space: nowrap;
        }
        .bootstrap-datetimepicker-widget.dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a {
            color: #ffffff;
            text-decoration: none;
            background-color: #0081c2;
            background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
            background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
            background-image: -o-linear-gradient(top, #0088cc, #0077b3);
            background-image: linear-gradient(to bottom, #0088cc, #0077b3);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0);
            cursor: pointer;
        }

        body
        {
            background: #FAFAFF;
        }
        .thumbnail
        {
            padding: 0px;
        }

        .grid-item { width: 500px }

    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    ACERC CS
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li>{{ link_to_route('home','Dashboard') }}</li>
                    @endif
                    <li>{{ link_to_route('news.index','News') }}</li>
                    <li>{{ link_to_route('event.index','Events') }}</li>
                    <li>{{ link_to_route('alumini.index','Alumini') }}</li>
                    <li><a href="">Gallery</a></li>
                    <li>{{ link_to_route('questions.index','Questions') }}</li>
                        <li>{{ link_to_route('codewar.index','Code War') }}</li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="spin"><a href="{{ route('users.profile.show',[Auth::user()->username]) }}"><i class="fa fa-btn fa-user"></i>My Profile</a></li>
                                <li class="spin"><a href="{{ route('users.profile.edit',[Auth::user()->username]) }}"><i class="fa fa-btn fa-cog"></i>Setting</a></li>
                                <li class="spin"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <form class="navbar-form navbar-right" role="search" action='/search/'>
                    <div class="form-group">
                        <input type="text" id="navsearch" name='q' class="form-control" placeholder="Members Search" autocomplete="off">
                    </div>
                    {{--<button type="submit" class="btn btn-default">Search</button>--}}
                </form>

            </div>
        </div>
    </nav>
    @if(Session::has('notification'))
    <div class="alert alert-info col-md-8 col-md-offset-2 text-center notification">
            {{ Session::get('notification') }}
    </div>
    @endif

    @yield('content')

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
