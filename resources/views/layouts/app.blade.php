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
                <a data-toggle="tooltip" data-placement="bottom" title="Department of Computer Science - ACERC" class="navbar-brand" href="{{ url('/') }}" style="padding: 6.5px 15px">
                    <img src="/images/static/logo.png" alt="ACERC" class="img" style="height: 50px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="{{ set_active(['news']) }}">{{ link_to_route('news.index','News') }}</li>
                    <li class="{{ set_active(['events']) }}">{{ link_to_route('event.index','Events') }}</li>
                    <li class="{{ set_active(['alumini']) }}">{{ link_to_route('alumini.index','Alumini') }}</li>
                    <li class="{{ set_active(['gallery']) }}">{{ link_to_route('gallery.index', 'Gallery') }}</li>
                    <li class="{{ set_active(['questions*']) }}">{{ link_to_route('questions.index','Questions') }}</li>
                    <li class="{{ set_active(['codewar*']) }}">{{ link_to_route('codewar.index','Codewar') }}</li>

                    {{-- DropDown for Extras --}}

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Extras <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-magic"></i>Showcase</a>
                            </li>
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-paperclip"></i>Notes</a>
                            </li>
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-laptop"></i>Computer
                                    Tricks</a></li>
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-quote-left"></i>Quotes</a>
                            </li>
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-fax"></i>Discuss
                                    Forum</a></li>
                        </ul>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ set_active(['login']) }}"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="{{ set_active(['register']) }}"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="spin {{ set_active(['dashboard']) }}"><a href="{{ route('home') }}"><i class="fa fa-btn fa-desktop"></i>Dashboard</a></li>
                                <li class="spin {{ set_active(["@".Auth::user()->username]) }}"><a href="{{ route('users.profile.show',[Auth::user()->username]) }}"><i class="fa fa-btn fa-user"></i>View Profile</a></li>
                                <li class="spin {{ set_active(["@".Auth::user()->username."/edit"]) }}"><a href="{{ route('users.profile.edit',[Auth::user()->username]) }}"><i class="fa fa-btn fa-cog"></i>Setting</a></li>
                                <li class="spin"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <form class="navbar-form navbar-right" role="search" action='/search/'>
                    <div class="form-group">
                        <input type="text" id="navsearch" name='q' class="form-control navsearch" placeholder="Search members" autocomplete="off">
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
