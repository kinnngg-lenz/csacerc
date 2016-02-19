@extends('layouts.app')
@section('title', "Aluminis")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                {{ link_to_route('alumini.create', 'Add New Alumini', [], ['class' => 'btn btn-danger btn-sm']) }}
                @endif
            </div>
            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Alumini Speak</h3></div>--}}

                <div class="grid js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 330 }'>
                @forelse($aluminis as $alumini)
                        <div class="col-sm-6 grid-item col-md-4">
                        <blockquote class="example-{{ ['obtuse','right','wrong'][array_rand([0,1,2])] }}">
                            <p>
                                {!! nl2br(htmlentities($alumini->speech)) !!}
                            </p>
                        </blockquote>
                        <p>
                            <b> - {{ $alumini->speaker }}</b><br>
                                        <span class="text-small">
                                            {{ $alumini->batch }} <br> ({{ $alumini->profession }})</span>
                            </p>
                         </div>
                @empty
                    Empty
                @endforelse
                    </div>
                </div>
                <div class="text-center">
                    {{ $aluminis->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
