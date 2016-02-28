@extends('layouts.app')
@section('title', 'About Us')
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
            font-size: 14px !important;
        }
        .inspire
        {
            font-size:2rem !important;;
        }
        .text-lg
        {
            font-size: 1.5em !important;
            font-family: "Trebuchet MS", Verdana, sans-serif;
        }
        .stats
        {
            font-size:18px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>About Us</h1>
                <p class="">All you want to know about college, department, team and this website.</p>
                <p class="tiny text-muted"></p>
            </div>

        </div>
    </div>
@endsection