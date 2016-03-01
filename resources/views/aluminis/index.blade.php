@extends('layouts.app')
@section('title', "Aluminis")
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
                <h1>Aluminis of ARYA</h1>
                <a href="" class="btn btn-info">Search By Organisation</a>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('alumini.create', 'Add New Alumini', [], ['class' => 'btn btn-danger btn-sm']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Alumini Speak</h3></div>--}}

                <div class="grid container">
                @forelse($aluminis as $alumini)

                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <img class="img img-circle" data-src="holder.js/100%x200" alt="100%x200" src="images/{{ $alumini->photo->url }}" data-holder-rendered="true" style="width:200px;height:200px;margin-top:15px;">
                                <div class="caption text-center">
                                    <h4>{{ $alumini->speaker }}</h4>
                                    <p class="text-center">
                                        {{ ($alumini->batch) }}
                                    </p>
                                    <p>
                                        <i>{{ $alumini->profession }} {{ $alumini->organisation_id != null ? "at ".$alumini->organisation->name : "" }}</i>
                                    </p>

                                    @if($alumini->speech != null && !empty($alumini))
                                    <p class="well well-sm">
                                        <i><span class='text-lg'>&#8220;</span> {{ $alumini->speech }} <span class='text-lg'>&#8221;</span>
                                        </i>
                                    </p>
                                    @endif
                                    <p class="blockquote-reverse">
                                        <b>Email:</b> {{ $alumini->email }}<br>
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
                    {{ $aluminis->render() }}
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
                "columnWidth": 330
            });
        });
    </script>
@endsection