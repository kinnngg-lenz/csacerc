@extends('layouts.app')
@section('title', 'Questions & Answers')
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
                <h1>Questions & Answers</h1>
                <p class="">Here you can find questions that are publically asked to someone</p>
                {{ link_to_route('questions.create', 'Ask Question!', [], ['class' => 'btn btn-info', 'title' => 'Ask anyone, anything Anonymously!', 'data-toggle' => 'tooltip']) }}
            </div>

            <div class="col-md-11 col-md-offset-1">

                @forelse($questions as $question)
                    <div class="panel col-md-11">
                        {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                        <div class="padding10">{!! (render_markdown_for_view($question->question)) !!}</div>
                        <div class="well well-sm padding10">
                            @if(is_null($question->answer))
                                @can('answer', $question)
                                <i class='text-danger'>Not answered yet!</i>
                                <div class="text-right">{{ link_to_route('questions.show', 'Answer this Question', [$question->slug], ['class' => 'btn btn-info btn-sm float-right']) }}</div>
                                @else
                                <i class='text-danger'>Not answered yet!</i>
                                @endcan
                            @else
                                    {{ link_to_route('questions.show', "View Answer", $question->slug, ['class' => 'btn btn-primary btn-sm']) }}
                            @endif
                        </div>

                        <p class="blockquote-reverse">
                        <span class="text-small">{{ link_to_route('questions.show', $question->created_at->diffForHumans(), $question->slug) }}<br></span>
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

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/highlight.pack.js') }}"></script>
    <script>
        $(document).ready(function(){
            hljs.initHighlightingOnLoad();
        });
    </script>
@endsection