@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{--<div class="col-md-12 text-right">
                {{ link_to_route('questions.create', 'Ask a Question', [], ['class' => 'btn btn-danger btn-sm']) }}
            </div>--}}
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Questions Pending</h3></div>
                @forelse($questions as $question)
                    <div class="panel col-md-11 well">
                        Question:
                        {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                        <div class="panel padding10">{!! (render_markdown_for_view(htmlentities($question->question))) !!}</div>
                        Action:
                        <div class="panel padding10">
                            {{ Form::open(['route' => ['questions.pending.approve', $question->id]]) }}
                            {{ Form::hidden('question_id',$question->id) }}
                            {{ Form::submit('Approve', ['class' => 'btn btn-success btn-sm']) }}
                            {{ Form::close() }}

                        </div>

                        {{--<div class="panel padding10">{!! is_null($question->answer) ? link_to_route('questions.show', 'Answer this Question', [$question->slug], ['class' => 'btn btn-info btn-sm']) : (Markdown::string(htmlentities($question->answer))) !!}</div>--}}
                        <p class="blockquote-reverse">
                            <span class="text-small">{{ link_to_route('questions.show', $question->created_at->diffForHumans(), $question->slug) }}<br></span>
                            <span class="text-small"><b>Visible to public: </b>{{ $question->public==1 ? 'Yes' : 'No' }}</span><br>
                            <span class="text-small"><b>Asked To: </b>{{ $question->askedTo()->name==null ? "Everybody" : $question->askedTo()->name }}</span>
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
