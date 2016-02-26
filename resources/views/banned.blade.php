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
    </style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1 class="white">Oops! You are Banned!</h1>
                <p class="white">This may be a reaction of some action done by you ;)</p>
                <p class="white">If you think you are banned without any valid reason then please contact administrator.</p>
            </div>
        </div>
    </div>
@endsection
