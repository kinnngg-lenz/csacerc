@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                {{ link_to_route('alumini.create', 'Add New Alumini', [], ['class' => 'btn btn-danger btn-sm']) }}
                @endif
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Alumini Speak</h3></div>
                @forelse($aluminis as $alumini)
                    <div class="panel col-md-5 well marginright10">
                        <p class="panel padding10">{!! nl2br($alumini->speech) !!}</p>
                        <p class="blockquote-reverse"><strong>
                        - {{ link_to_route('alumini.show', $alumini->speaker, $alumini->slug) }}<br></strong>
                        <span class="text-small">{{ $alumini->batch }}<br>
                        ( {{ $alumini->profession }} )</span>
                        </p>
                    </div>
                @empty
                    Empty
                @endforelse
                </div>
                <div class="text-center">
                    {{ $aluminis->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
