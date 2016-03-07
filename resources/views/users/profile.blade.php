@extends('layouts.app')
@section('title', $user->name)
@section('styles')
    <style>
        .jumbotron {
            background: url('/images/static/head.png') #573e81;
            margin-top: -28px;
            border-radius: 0px !important;
            color: white;
        }

        .jumbotron pre {
            padding: 0px;
            border: none;
            border-radius: 0px;
        }

        pre {
            padding: 0px;
        }

        h1 {
            font-size: 300% !important;
        }

        .tiny {
            font-size: 14px;
        }

        .xp-btn {
            margin-top: 5px;;
        }

        /* code for animated blinking cursor */
        .typed-cursor {
            opacity: 1;
            font-weight: 100;
            -webkit-animation: blink 0.7s infinite;
            -moz-animation: blink 0.7s infinite;
            -ms-animation: blink 0.7s infinite;
            -o-animation: blink 0.7s infinite;
            animation: blink 0.7s infinite;
        }

        @-keyframes blink {

        0
        %
        {
            opacity: 1
        ;
        }
        50
        %
        {
            opacity: 0
        ;
        }
        100
        %
        {
            opacity: 1
        ;
        }
        }
        @-webkit-keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @-moz-keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @-ms-keyframes blink {

        0
        %
        {
            opacity: 1
        ;
        }
        50
        %
        {
            opacity: 0
        ;
        }
        100
        %
        {
            opacity: 1
        ;
        }
        }
        @-o-keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }


    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img img-thumbnail"
                             src="/images/{{ $user->getProfilePicUrl() }}" width="250"
                             height="250"/>
                        {{--<img class="img-thumbnail" src="/images/static/{{ $user->gender }}.jpeg" alt="Female" style="height: 250px">--}}
                    </div>
                    <div class="col-md-9">
                        <button class="btn btn-info xp-btn btn-sm disabled pull-right" href="#">
                            <i class="fa fa-trophy"></i>
                            XP &nbsp;<span class="badge text-danger">{{ $user->xp }}</span>
                        </button>

                        <h1 class="nomargin">{{ $user->name }}</h1><i class="text-muted">( {{ $user->rank() }} )</i>
                        <p class="text-warning"><a class="text-warning"
                                                   href="{{ route('users.profile.show',$user->username) }}">{{ "@".$user->username }}</a>
                        </p>
                        @unless($user->dob == null)
                            <p><i class="fa fa-birthday-cake"></i> {{ $user->dob->format('jS F') }}</p>
                        @endunless
                        <div id="typed-strings">
                            <p class="hidden">Few words about me . . .</p>
                            <p>{!! nl2br(htmlentities($user->about)) !!}</p>
                        </div>
                        <p class="about"><span id="typed"></span></p>
                    </div>
                </div>

                <p class="text-muted blockquote-reverse">
                    {{ $user->gta() }}
                </p>
                <p class="text-muted blockquote-reverse">
                    {{ $user->gca() }}
                    <br><span class="tiny">{{ $user->gda() }} ({{ $user->batch }})</span>
                </p>
                <p class="text-muted blockquote-reverse">
                    Joined {{  $user->created_at->diffForHumans()}}
                </p>

                <div class="col-md-6 row">
                    @if(Auth::check() && Auth::user()->isSuperAdmin())
                        <div class="col-md-3">
                            {{ Form::open(['method' => 'patch', 'route' => ['users.toggleban',$user->username]]) }}
                            {{ Form::hidden('username',$user->username) }}
                            @if($user->banned == 1)
                                {{ Form::submit('Unban @'.$user->username,['class' => 'btn btn-success btn-sm']) }}
                            @else
                                {{ Form::submit('Ban @'.$user->username,['class' => 'btn btn-danger btn-sm']) }}
                            @endif
                            {{ Form::close() }}
                        </div>
                    @endif
                    @unless(Auth::check() && $user->id == Auth::user()->id)
                    <div class="col-md-3">
                        {{ link_to_route('messages.show',"Send Message",$user->username,['class' => 'btn btn-info btn-sm']) }}
                    </div>
                    @endunless
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">

            </div>
        </div>
    </div>

    </div>
@endsection

@section('scripts')
    <script src="/js/typed.min.js" type="text/javascript"></script>
    <script>
        $(function () {

            $("#typed").typed({
                stringsElement: $('#typed-strings'),
                typeSpeed: 40,
                contentType: 'html' // or text
                // defaults to false for infinite loop

            });
        });
    </script>
@endsection