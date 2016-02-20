@extends('layouts.app')
@section('title', 'Coming Soon')
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
    </style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1 class="white">Coming Soon!</h1>
                <p class="white">The feature you requested is in development phase.</p>
                <p class="white">Please request later to avail this feature.</p>
            </div>
        </div>
    </div>
@endsection
