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
                <div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>News &amp Happening</h3></div>
                @forelse($allnews as $news)
                    <div class="panel col-md-5 well marginright10">
                        <h4 class="text-center">{{ link_to_route('news.show',$news->title,$news->slug) }}</h4>
                        <img class="col-md-12" src="images/{{ $news->photo->url }}" alt="News Poster" width="">
                        {{-- @TODO: Fix this in production --}}
                        {{-- Html::image(public_path('images/').$news->photo->url) --}}
                        <div class="panel padding10">{!! nl2br(render_markdown_for_view($news->description)) !!}</div>
                        {{--<p class="blockquote-reverse"><strong>
                               Venue - {{ $news->venue }}<br></strong>
                        <span class="text-small">{{ $news->batch }}<br>
                        {{ $news->date->toFormattedDateString() }} <br> ({{ $news->date->diffForHumans() }})</span>
                        </p>--}}
                    </div>
                @empty
                    Empty
                @endforelse
            </div>
            <div class="text-center">
                {{ $allnews->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection
