@extends('layouts.app')

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
        pre
        {
            padding: 0px;
        }
        h1 {
            font-size: 300% !important;
        }
        .tiny {
            font-size: 14px;
        }
        .xp-btn
        {
            margin-top: 5px;;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron">
                <div class="col-md-3">
                    <img class="img-thumbnail" src="/images/static/{{ $user->gender }}.jpeg" alt="Female" style="height: 250px">
                </div>
                <button class="btn btn-info xp-btn btn-sm disabled pull-right" href="#">
                    <i class="fa fa-trophy"></i>
                    XP &nbsp;<span class="badge text-danger">{{ $user->xp }}</span>
                </button>
                    <h1>{{ $user->name }}</h1>
                    <p class="text-warning"><a class="text-warning" href="{{ route('users.profile.show',$user->username) }}">{{ "@".$user->username }}</a></p>
                    <p><i class="fa fa-birthday-cake"></i> {{ $user->dob->format('jS F') }}</p>
                <p class="about">{!! nl2br(htmlentities($user->about)) !!}</p>


                <p class="text-muted blockquote-reverse">
                    {{ $user->gta() }}
                </p>
                <p class="text-muted blockquote-reverse">
                    {{ $user->gca() }}
                    <br><span class="tiny">{{ $user->gda() }}</span>
                </p>
                <p class="text-muted blockquote-reverse">
                    Joined {{  $user->created_at->diffForHumans()}}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">

            </div>
        </div>

    </div>
@endsection
