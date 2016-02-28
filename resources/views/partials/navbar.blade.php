@if(!Agent::isMobile() && !is_null(Request::route()) && Request::route()->getName() == 'welcome')
<style>
    #aryaheader
    {
        min-height: 280px;
        background: rgb(152,159,43) url('/images/static/header.jpg') no-repeat scroll 0% 51%;
    }
    .image
    {
        width: 100%;
        margin: 40px auto;
    }
    body
    {
        padding-top: 0px !important;
    }
</style>
<div class="header-img hidden-xs" id="aryaheader">
    <div class="container-fluid">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <img src="/images/static/header.png" alt="Header" class="image">
        </div>
    </div>
</div>
<nav class="navbar navbar-scroll navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a data-toggle="tooltip" data-placement="bottom" title="Department of Computer Science - ACERC"
               class="navbar-brand" href="{{ url('/') }}" style="padding: 6.5px 15px">
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
                <li class="{{ set_active(['codewar*']) }}">{{ link_to_route('codewar.index','Codewar') }}</li>
                <li class="{{ set_active(['notes']) }}">{{ link_to_route('notes.index','Notes') }}</li>

                {{-- DropDown for Extras --}}

                <li class="dropdown {{-- set_active(['question*','aboutus','quotes']) --}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        More <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="spin {{ set_active(['questions*']) }}"><a href="{{ route('questions.index') }}"><i
                                        class="fa fa-btn fa-question"></i>Questions</a>
                        </li>
                        <li class="spin {{ set_active(['quotes']) }}"><a href="{{ route('quotes.index') }}"><i class="fa fa-btn fa-quote-left"></i>Quotes</a>
                        </li>
                        <li class="spin"><a href="{{ url('/comingsoon') }}"><i
                                        class="fa fa-btn fa-magic"></i>Showcase</a>
                        </li>
                        <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-laptop"></i>Computer
                                Tricks</a></li>
                        <li class="spin {{ set_active(['aboutus']) }}"><a href="{{ url('/aboutus') }}"><i class="fa fa-btn fa-university"></i>About Us</a>
                        </li>
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
                            <img class="img" src="//gravatar.com/avatar/{{ Auth::user()->getGravatarId() }}?d=mm&s=20"
                                 width="20" height="20"/>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="spin {{ set_active(['dashboard']) }}"><a href="{{ route('home') }}"><i
                                            class="fa fa-btn fa-desktop"></i>Dashboard</a></li>
                            <li class="spin {{ set_active(["@".Auth::user()->username]) }}"><a
                                        href="{{ route('users.profile.show',[Auth::user()->username]) }}"><i
                                            class="fa fa-btn fa-user"></i>View Profile</a></li>
                            <li class="spin {{ set_active(["@".Auth::user()->username."/edit"]) }}"><a
                                        href="{{ route('users.profile.edit',[Auth::user()->username]) }}"><i
                                            class="fa fa-btn fa-cog"></i>Setting</a></li>
                            <li class="spin"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <form class="navbar-form navbar-right" role="search" action='/search/'>
                <div class="form-group">
                    <input type="text" id="navsearch" name='q' class="form-control navsearch"
                           placeholder="Search members" autocomplete="off">
                </div>
                {{--<button type="submit" class="btn btn-default">Search</button>--}}
            </form>

        </div>
    </div>
</nav>

@else
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a data-toggle="tooltip" data-placement="bottom" title="Department of Computer Science - ACERC"
                   class="navbar-brand" href="{{ url('/') }}" style="padding: 6.5px 15px">
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
                    <li class="{{ set_active(['codewar*']) }}">{{ link_to_route('codewar.index','Codewar') }}</li>
                    <li class="{{ set_active(['notes']) }}">{{ link_to_route('notes.index','Notes') }}</li>

                    {{-- DropDown for Extras --}}

                    <li class="dropdown {{-- set_active(['question*','aboutus','quotes']) --}}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            More <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="spin {{ set_active(['questions*']) }}"><a href="{{ route('questions.index') }}"><i
                                            class="fa fa-btn fa-question"></i>Questions</a>
                            </li>
                            <li class="spin {{ set_active(['quotes']) }}"><a href="{{ route('quotes.index') }}"><i class="fa fa-btn fa-quote-left"></i>Quotes</a>
                            </li>
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i
                                            class="fa fa-btn fa-magic"></i>Showcase</a>
                            </li>
                            <li class="spin"><a href="{{ url('/comingsoon') }}"><i class="fa fa-btn fa-laptop"></i>Computer
                                    Tricks</a></li>
                            <li class="spin {{ set_active(['aboutus']) }}"><a href="{{ url('/aboutus') }}"><i class="fa fa-btn fa-university"></i>About Us</a>
                            </li>
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
                                <img class="img" src="//gravatar.com/avatar/{{ Auth::user()->getGravatarId() }}?d=mm&s=20"
                                     width="20" height="20"/>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="spin {{ set_active(['dashboard']) }}"><a href="{{ route('home') }}"><i
                                                class="fa fa-btn fa-desktop"></i>Dashboard</a></li>
                                <li class="spin {{ set_active(["@".Auth::user()->username]) }}"><a
                                            href="{{ route('users.profile.show',[Auth::user()->username]) }}"><i
                                                class="fa fa-btn fa-user"></i>View Profile</a></li>
                                <li class="spin {{ set_active(["@".Auth::user()->username."/edit"]) }}"><a
                                            href="{{ route('users.profile.edit',[Auth::user()->username]) }}"><i
                                                class="fa fa-btn fa-cog"></i>Setting</a></li>
                                <li class="spin"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <form class="navbar-form navbar-right" role="search" action='/search/'>
                    <div class="form-group">
                        <input type="text" id="navsearch" name='q' class="form-control navsearch"
                               placeholder="Search members" autocomplete="off">
                    </div>
                    {{--<button type="submit" class="btn btn-default">Search</button>--}}
                </form>

            </div>
        </div>
    </nav>
@endif