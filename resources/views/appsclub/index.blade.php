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
                <h1>Apps Club</h1>
                <p class="text-lg">Apps Club is responsible for organisation of competitions and codewar
                for department of computer science at acerc.
                </p>
                <!-- Single button -->
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