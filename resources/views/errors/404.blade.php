@extends('layouts.app')
@section('title', 'Oop! You are Banned')
@section('styles')
    <style>
        .jumbotron {
            background: url('/images/static/head.png') #573e81;
            margin-top: -58px;
            border-radius: 0px !important;
            color: white;
            height: 520px;
            padding-top: 100px !important;
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
        .white {
            color: white !important;
        }
        footer
        {
            position: absolute;
            width: 100%;
            bottom: 0;
        }
        .red
        {
            color: #D53735 !important;
        }
        .typed-cursor{
            opacity: 1;
            -webkit-animation: blink 0.7s infinite;
            -moz-animation: blink 0.7s infinite;
            animation: blink 0.7s infinite;
        }
        @keyframes blink{
            0% { opacity:1; }
            50% { opacity:0; }
            100% { opacity:1; }
        }
        @-webkit-keyframes blink{
            0% { opacity:1; }
            50% { opacity:0; }
            100% { opacity:1; }
        }
        @-moz-keyframes blink{
            0% { opacity:1; }
            50% { opacity:0; }
            100% { opacity:1; }
        }
    </style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1 class="red">Oops! Its's a <span id="typed"></span></h1>
                <h2 class="white">The page you are looking for is not found</h2>
                <p class="white">Maybe you have typed something wrong or url has changed.</p>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="/js/typed.min.js" type="text/javascript"></script>
    <script>
        $(function () {

            $("#typed").typed({
                strings: ['404','451'],
                typeSpeed: 100,
                contentType: 'text', // or text
                // time before typing starts
                startDelay: 500,
                // backspacing speed
                backSpeed: 100,
                // time before backspacing
                backDelay: 500,
                // loop
                loop: true,
                // false = infinite
                loopCount: false,
            });
        });
    </script>
@endsection