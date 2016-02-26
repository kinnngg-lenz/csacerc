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
            <h1>Dashboard</h1>
            <p id="ajaxinspire">
                <span class="inspire text-{{ ['warning','success','info', 'danger', 'yellow', 'pink', 'green', 'violet', 'muted'][array_rand([0,1,2,3,4,5,6,7,8])] }}"><span class="text-lg">&#8220;</span> {{ Illuminate\Foundation\Inspiring::quote() }} <span class="text-lg">&#8221;</span></span>
            </p>
            <p class="">Welcome abroad <span style="color: #91B5FF;">{{ Auth::user()->name }}</span> </p>
            <p class="tiny text-muted">Your rank is <b>{{ Auth::user()->rank() }}</b></p>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><b> <i class="fa fa-bar-chart"></i> Your Statistics</b></div>
                <div class="panel-body text-center stats">
                    <p>You have <kbd class="text-lg">{{ Auth::user()->xp }}</kbd> e<b>X</b>perience points <i class="fa fa-trophy"></i> </p>
                    <p>You have attempted <kbd class="text-lg">{{ Auth::user()->codeWarAnswers->count() }}</kbd> codewars <i class="fa fa-code"></i></p>
                    <p>You have asked <kbd class="text-lg">{{ Auth::user()->questions->count() }}</kbd> questions <i class="fa fa-question"></i> </p>
                    {{-- <a href="{{ route('questions.user.unanswered') }}">You have {{ Auth::user()->notAnsweredQuestions()->approved()->count().str_plural(' question', Auth::user()->notAnsweredQuestions()->count()) }} to answer.</a>--}}
                    <br>
                </div>
            </div>
        </div>

        @if(Auth::user()->isAdmin())
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><b> <i class="fa fa-user"></i> Admin Panel</b> (<i>{{ Auth::user()->rank() }}</i>)</div>
                <div class="panel-body">
                    {{ link_to_route('news.create', 'Add a News', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                    {{ link_to_route('alumini.create', 'Add an Alumini', [], ['class' => 'btn btn-danger btn-block btn-sm']) }}
                    {{ link_to_route('event.create', 'Add an Event', [], ['class' => 'btn btn-success btn-block btn-sm']) }}
                    {{ link_to_route('questions.pending', 'Pending Questions', [], ['class' => 'btn btn-primary btn-block btn-sm']) }}
                    {{ link_to_route('codewar.create', 'Create a CodeWar', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                    {{ link_to_route('gallery.create', 'Add Image to Gallery', [], ['class' => 'btn btn-warning btn-block btn-sm']) }}
                </div>
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><b> <i class="fa fa-question-circle"></i> Questions</b></div>
                    <div class="panel-body">
                        <a data-toggle="tooltip" data-placement="left" title="Question that are asked to you by someone" class="btn btn-sm btn-block btn-info" href="{{ route('questions.user.unanswered') }}">To be answered <span class="badge">{{Auth::user()->notAnsweredQuestions()->approved()->count()}}</span></a>
                        <a data-toggle="tooltip" data-placement="left" title="Question that you asked to someone" class="btn btn-sm btn-block btn-info" href="{{ route('questions.iasked') }}">I Asked</a>
                    </div>
                </div>
        </div>
        @else
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Questions</b></div>
                    <div class="panel-body">
                        <a data-toggle="tooltip" data-placement="left" title="Question that are asked to you by someone" class="btn btn-sm btn-block btn-info" href="{{ route('questions.user.unanswered') }}">To be answered <span class="badge">{{Auth::user()->notAnsweredQuestions()->approved()->count()}}</span></a>
                        <a data-toggle="tooltip" data-placement="left" title="Question that you asked to someone" class="btn btn-sm btn-block btn-info" href="{{ route('questions.iasked') }}">I Asked</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // Quotes AJAX load
        function update_div()
        {
            $('#ajaxinspire').fadeOut('normal', function()
            {
                $('#ajaxinspire').load('/inspire');
                $('#ajaxinspire').fadeIn(3000, function()
                {
                    window.setTimeout("update_div()", 8000);
                });
            });
        }
        update_div();
    </script>
@endsection