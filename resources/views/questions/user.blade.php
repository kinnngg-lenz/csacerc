@extends('layouts.app')
@section('title', 'Question Pending Answer (Asked to you)')
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
                <h1>Questions Asked to You</h1>
                <p class="">These are questions that are asked to you by someone</p>
                {{ link_to_route('questions.create', 'Ask', [], ['class' => 'btn btn-info']) }}
            </div>

            <div class="col-md-11 col-md-offset-1">

                @forelse($questions as $question)
                    <div class="panel col-md-11">
                        {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                        <div class="padding10">{!! render_markdown_for_view($question->question) !!}</div>

                        <div class="well padding10">
                            @if(is_null($question->answer))
                                @can('answer', $question)
                                <i class='text-danger'>Not answered yet!</i>
                                <div class="text-right">{{ link_to_route('questions.show', 'Answer this Question', [$question->slug], ['class' => 'btn btn-info btn-sm float-right']) }}</div>
                            @else
                                <i class='text-danger'>Not answered yet!</i>
                                @endcan
                                @else
                                    {{ link_to_route('questions.show', "View Answer", $question->slug, ['class' => 'btn btn-sm btn-primary']) }}
                                @endif
                        </div>

                        {{--<div class="panel padding10">{!! is_null($question->answer) ? link_to_route('questions.show', 'Answer this Question', [$question->slug], ['class' => 'btn btn-info btn-sm']) : (Markdown::string(htmlentities($question->answer))) !!}</div>--}}
                        <p class="blockquote-reverse">
                            <span class="text-small">{{ link_to_route('questions.show', $question->created_at->diffForHumans(), $question->slug) }}<br></span>
                            <span class="text-small"><b>Visible to public: </b>{{ $question->public==1 ? 'Yes' : 'No' }}</span>
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
