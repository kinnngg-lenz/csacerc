@extends('layouts.app')
@section('title', 'Dashboard')
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
            <h1>Dashboard</h1>
            <p class="">Welcome abroad {{ Auth::user()->name }} </p>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <a class="btn btn-success" href="{{ route('questions.iasked') }}">Question I Asked</a>

                    <a class="btn btn-primary" href="{{ route('questions.user.unanswered') }}">Pending Questions to Answer <span class="badge">{{Auth::user()->notAnsweredQuestions()->approved()->count()}}</span></a>
                    {{-- <a href="{{ route('questions.user.unanswered') }}">You have {{ Auth::user()->notAnsweredQuestions()->approved()->count().str_plural(' question', Auth::user()->notAnsweredQuestions()->count()) }} to answer.</a>--}}
                    <br>Your rank is <b>{{ Auth::user()->rank() }}</b>
                </div>
            </div>
        </div>

        @if(Auth::user()->isAdmin())
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Panel</div>
                <div class="panel-body">
                    {{ link_to_route('news.create', 'Add a News', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                    {{ link_to_route('alumini.create', 'Add an Alumini', [], ['class' => 'btn btn-danger btn-block btn-sm']) }}
                    {{ link_to_route('event.create', 'Add an Event', [], ['class' => 'btn btn-success btn-block btn-sm']) }}
                    {{ link_to_route('questions.pending', 'Pending Questions', [], ['class' => 'btn btn-primary btn-block btn-sm']) }}
                    {{ link_to_route('codewar.create', 'Create a CodeWar', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                    {{ link_to_route('gallery.create', 'Add Image to Gallery', [], ['class' => 'btn btn-success btn-block btn-sm']) }}
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
