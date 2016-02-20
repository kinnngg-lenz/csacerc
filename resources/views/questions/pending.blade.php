@extends('layouts.app')
@section('title', 'Questions Pending Approval')
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
                <h1>Questions Pending Approval</h1>
                <p class="">Since you have Admin Rights, you can approve a question here</p>
            </div>

            {{--<div class="col-md-12 text-right">
                {{ link_to_route('questions.create', 'Ask a Question', [], ['class' => 'btn btn-danger btn-sm']) }}
            </div>--}}
            <div class="col-md-11 col-md-offset-1">

                @forelse($questions as $question)
                    <div class="panel col-md-11">
                        {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                        <div class="padding10">{!! (render_markdown_for_view(htmlentities($question->question))) !!}</div>

                        <div class="well padding10">
                            {{ Form::open(['route' => ['questions.pending.approve', $question->id]]) }}
                            {{ Form::hidden('question_id',$question->id) }}
                            {{ Form::submit('Approve', ['class' => 'btn btn-success btn-sm']) }}
                            {{ Form::close() }}

                        </div>

                        {{--<div class="panel padding10">{!! is_null($question->answer) ? link_to_route('questions.show', 'Answer this Question', [$question->slug], ['class' => 'btn btn-info btn-sm']) : (Markdown::string(htmlentities($question->answer))) !!}</div>--}}
                        <p class="blockquote-reverse">
                            <span class="text-small">{{ link_to_route('questions.show', $question->created_at->diffForHumans(), $question->slug) }}<br></span>
                            <span class="text-small"><b>Visible to public: </b>{{ $question->public==1 ? 'Yes' : 'No' }}</span><br>
                            <span class="text-small"><b>Asked To: </b>{{ $question->askedTo()->name==null ? "Everybody" : link_to_route('users.profile.show',$question->askedTo()->name,$question->askedTo()->username) }}</span>
                        </p>
                    </div>
                @empty
                    Empty
                @endforelse
            </div>
            <div class="text-center">
                {{ $questions->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection
