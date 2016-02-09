@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Question Viewer</h3></div>--}}

                <div class="panel col-md-11 well">
                    Question:
                    {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                    <div class="panel padding10">{!! (Markdown::string(htmlentities($question->question))) !!}</div>
                    Answer:
                    @if(is_null($question->answer))
                        @can('answer', $question))
                            Can Answer
                        @else
                            Cant Answer
                        @endcan

                    @else
                        <div class="panel padding10">{!! Markdown::string(htmlentities($question->answer)) !!}</div>
                    @endif
                    <p class="blockquote-reverse">
                        <span class="text-small">{{ link_to_route('questions.show', $question->created_at->diffForHumans(), $question->slug) }}<br></span>
                        <span class="text-small"><b>Visible to public: </b>{{ $question->public==1 ? 'Yes' : 'No' }}</span>
                    </p>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
