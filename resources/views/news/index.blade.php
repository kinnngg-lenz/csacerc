@extends('layouts.app')
@section('title', 'News & Happenings')
@section('styles')
    <style>
     @media screen and (min-width: 768px) {
         .grid-item {
             width: 500px;
         }
     }
     @media (max-width: 767px) {
         .grid-item {
             width: 300px;
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
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('news.create', 'Add New News', [], ['class' => 'btn btn-info btn-sm']) }}
                @endif
            </div>
            <div class="col-md-11 col-md-offset-1">

                <div class="grid js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 500 }'>
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
                                    <i class="padding10 small text-muted">By {{ $news->user->name }}</i>
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
