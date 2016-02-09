@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="{{ route('questions.user.unanswered') }}">You have {{ Auth::user()->notAnsweredQuestions()->count() }} questions to answer.</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
