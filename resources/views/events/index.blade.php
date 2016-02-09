@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('event.create', 'Add New Event', [], ['class' => 'btn btn-danger btn-sm']) }}
                @endif
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>College Events</h3></div>
                @forelse($events as $event)
                    <div class="panel col-md-5 well marginright10">
                        <h4 class="text-center">{{ link_to_route('event.show',$event->name,$event->slug) }}</h4>
                        <img class="col-md-12" src="images/{{ $event->photo->url }}" alt="Event Poster" width="">
                        {{-- @TODO: Fix this in production --}}
                        {{-- Html::image(public_path('images/').$event->photo->url) --}}
                        <p class="panel padding10">{!! nl2br($event->description) !!}</p>
                        <p class="blockquote-reverse"><strong>
                               Venue - {{ $event->venue }}<br></strong>
                        <span class="text-small">{{ $event->batch }}<br>
                        {{ $event->date->toFormattedDateString() }} <br> ({{ $event->date->diffForHumans() }})</span>
                        </p>
                    </div>
                @empty
                    Empty
                @endforelse
            </div>
            <div class="text-center">
                {{ $events->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection
