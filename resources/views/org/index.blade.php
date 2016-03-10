@extends('layouts.app')
@section('title', "Organisations")
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
                <h1>Organisations/Recruiters</h1>
                <!-- Single button -->
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('org.create', 'Add Organisation', [], ['class' => 'btn btn-primary btn-sm']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Alumini Speak</h3></div>--}}

                <div class="grid container">
                    @forelse($orgs as $org)

                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <img class="img" data-src="holder.js/100%x200" alt="100%x200" src="images/{{ $org->getPhoto() }}" data-holder-rendered="true" style="width: 100%;height:200px;">
                                <div class="caption text-center">
                                    <h4>{{ $org->name }}</h4>
                                    <p class="text-center">

                                    </p>

                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-sm-8 text-center grid-item col-md-8" style="width:90% !important;">
                            <div class="thumbnail">
                                <h1>List is Empty</h1>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="text-center">
                {{ $orgs->render() }}
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