@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('news.create', 'Add New News', [], ['class' => 'btn btn-danger btn-sm']) }}
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
                                            {{ $news->created_at->toFormattedDateString() }} <br> ({{ $news->created_at->diffForHumans() }})</span>
                                    </p>
                                    <h4>{{ $news->title }}</h4>
                                    <p class="well">
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
