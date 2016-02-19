@extends('layouts.app')
@section('title', 'Events')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('event.create', 'Add New Event', [], ['class' => 'btn btn-info btn-sm']) }}
                @endif
            </div>
            <div class="col-md-11 col-md-offset-1">

                <div class="grid js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 330 }'>
                @forelse($events as $event)

                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <img data-src="holder.js/100%x200" alt="100%x200" src="images/{{ $event->photo->url }}" data-holder-rendered="true" style="height: 100%; width: 500px; display: block;">
                                <div class="caption">
                                    <h4>{{ $event->name }}</h4>
                                    <p class="well">
                                        {!! nl2br($event->description) !!}
                                    </p>
                                    <p class="blockquote-reverse">
                                        <b>Venue:</b> {{ $event->venue }}<br>
                                        <span class="text-small">
                                            {{ $event->date->toFormattedDateString() }} <br> ({{ $event->date->diffForHumans() }})</span>
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
                {{ $events->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection
