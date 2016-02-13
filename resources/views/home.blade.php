@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    {{ link_to_route('questions.iasked', 'My Asked Questions') }}<br>
                    <a href="{{ route('questions.user.unanswered') }}">You have {{ Auth::user()->notAnsweredQuestions()->approved()->count().str_plural(' question', Auth::user()->notAnsweredQuestions()->count()) }} to answer.</a>
                    <br>Your rank is <b>{{ Auth::user()->rank() }}</b>
                </div>
            </div>
        </div>

        @if(Auth::user()->isAdmin())
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Functions</div>
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
