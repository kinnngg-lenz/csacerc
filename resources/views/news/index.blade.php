@extends('layouts.app')
@section('title', 'News & Happenings')
@section('styles')
    <style>
     @media screen and (min-width: 768px) {
         .grid-item {
             width: 520px;
         }
     }
     @media (max-width: 767px) {
         .grid-item {
             width: 100%;
         }
     }
    .text-bold
    {
        font-weight: bolder !important;
    }
    .title
    {
        margin: 0 !important;
    }
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
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="jumbotron text-center">
                <h1>News &amp; Happening</h1>
                <p class="">All about what's going on the college and surrounding</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('news.create', 'Add News', [], ['class' => 'btn btn-info btn-sm']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">

                <div class="grid">
                @forelse($allnews as $news)

                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <img data-src="holder.js/100%x200" alt="100%x200" src="images/{{ $news->photo->url }}" data-holder-rendered="true" style="height: 100%; width: 500px; display: block;">
                                <div class="caption">
                                    <p class="blockquote-reverse">
                                        <span class="text-small">
                                            {{ $news->created_at->toDayDateTimeString() }} <br>
                                            {{--({{ $news->created_at->diffForHumans() }}) <br>--}}
                                        </span>
                                    </p>
                                    <h3 class="text-bold padding10 title">{{ $news->title }}</h3>
                                    <i class="padding10 small text-muted">By <a class="text-muted" href="{{ route('users.profile.show',$news->user->username) }}">{{ $news->user->name }}</a></i>
                                    <p class="padding10 text-justify">
                                        {!! nl2br($news->description) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                @empty
                    Empty
                @endforelse
            </div>
                </div>
            <div class="text-center">
                {{ $allnews->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        /**
         * Masonry
         */
        $(window).load(function(){
            $('.grid').masonry({
                itemSelector: ".grid-item",
                "columnWidth": 520
            });
        });
    </script>
@endsection