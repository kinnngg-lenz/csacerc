<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Department of Computer Science - ACERC</title>

    <!-- Fonts -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>--}}

    <!-- Styles -->
    {{--<link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">--}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
     <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    {{ Html::style('/css/fa/css/font-awesome.min.css') }}
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
                    <li>{{ link_to_route('gallery.index', 'Gallery') }}</li>
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
                        <input type="text" id="navsearch" name='q' class="form-control navsearch" placeholder="Members Search" autocomplete="off">
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
