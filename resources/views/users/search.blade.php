@extends('layouts.app')
@section('title', 'Search Results: '.Request::get('q'))
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
        .media
        {
            border:1px solid #E7E7E7;
            padding: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>Search Result</h1>
                <p>{{ $users->count() }} {{ str_plural('user',$users->count()) }} were found for the search for "{{ Request::get('q') }}"</p>
                <p>{{ $users->count() }} {{ str_plural('alumini',$users->count()) }} were found for the search for "{{ Request::get('q') }}"</p>
            </div>

            <div class="col-md-11 col-md-offset-1">

                <div class="col-md-5 panel panel-primary padding10">
                    <div class="panel-heading">
                        Users
                    </div>
                @forelse($users as $user)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ route('users.profile.show',$user->username) }}">
                                <img width="100" height="100" class="media-object" src="/image/{{ $user->getProfilePicUrl() }}/thumbnail/100" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ route('users.profile.show',$user->username) }}">
                            <h4 class="media-heading">{{ $user->name }} <span class="tiny">{{ "@".$user->username }}</span> </h4>
                            </a>
                            <p class="text-danger small nomargin">
                                {{ $user->gta() }}
                            </p>
                            <p class="small text-primary nomargin">
                                {{ $user->gca() }}
                            </p>
                            <p class="small text-muted">
                                {{ $user->gda() }} {{ $user->batch==null || $user->batch=="" ? "" :  "(".$user->batch.")" }}
                            </p>
                        </div>
                    </div>
                @empty
                        <div class="thumbnail text-center">
                            <h1>No User Found</h1>
                            <h4>No user found with anything related "{{ Request::get('q') }}"</h4>
                        </div>
                @endforelse
                </div>

                <div class="col-md-5 col-md-offset-1 panel panel-primary padding10">
                    <div class="panel-heading">
                        Aluminis
                    </div>
                    @forelse($aluminis as $alumini)
                        <div class="media">
                            <div class="media-left">
                                    <img width="100" height="100" class="media-object" src="/image/{{ $alumini->getPhoto() }}/thumbnail/100" alt="...">
                            </div>
                            <div class="media-body">
                                    <h4 class="media-heading">{{ $alumini->speaker }} </h4>
                                <p class="text-danger small nomargin">
                                    {{ ($alumini->batch) }}<br>
                                </p>
                                <p class="small text-primary nomargin">
                                    {{ $alumini->department->name or "" }}
                                </p>
                                <p class="small text-muted nomargin">
                                    <i>{{ $alumini->profession }} {{ $alumini->organisation_id != null ? "at ".$alumini->organisation->name : "" }}</i>
                                </p>
                                <p class="small">
                                    <i class="fa fa-envelope-o"></i> {{ $alumini->email }}
                                </p>
                            </div>
                        </div>
                    @empty
                            <div class="thumbnail text-center">
                                <h1>No Alumini Found</h1>
                                <h4>No alumini found with anything related "{{ Request::get('q') }}"</h4>
                            </div>
                    @endforelse
                </div>

            </div>
            <div class="text-center">
                @if($users->count() >= $aluminis->count())
                {!! $users->appends(Request::only('q'))->links() !!}
                @else
                {!! $aluminis->appends(Request::only('q'))->links() !!}
                @endif
            </div>
        </div>
    </div>
@endsection