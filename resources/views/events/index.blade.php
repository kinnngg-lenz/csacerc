@extends('layouts.app')
@section('title', 'Events')
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
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>Events</h1>
                <p class="">All Upcomming and past events held on the college</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('event.create', 'Add an Event', [], ['class' => 'btn btn-info btn-sm']) }}
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
