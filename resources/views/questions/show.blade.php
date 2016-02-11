@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Question Viewer</h3></div>--}}

                <div class="panel col-md-11 well">
                    Question:
                    {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                    <div class="panel padding10">{!! (render_markdown_for_view($question->question)) !!}</div>
                    Answer:
                    @if(is_null($question->answer))
                        @can('answer', $question)
                            {{ Form::open(['method' => 'patch', 'class' => 'form-horizontal']) }}
                        
                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                {{ Form::textarea('answer',null,['class' => 'form-control']) }}
                                    <div class="text-info small">Github flavored <b>Markdown</b> supported</div>
                                @if ($errors->has('answer'))
                                <span class="help-block">
                                <strong>{{ $errors->first('answer') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>

                            {{ Form::hidden('question_id',$question->id) }}

                        <div class="form-group">
                            <div class="col-md-6">
                                {{ Form::submit('Submit Answer', ['class' => 'btn btn-info']) }}
                                {{ Form::reset('Reset Form', ['class' => 'btn btn-warning']) }}
                            </div>
                        </div>

                            {{ Form::close() }}
                        @else
                        <i class='text-danger'>No answered yet!</i>
                        @endcan
                    @else
                        <div class="panel padding10">{!! render_markdown_for_view($question->answer) !!}</div>
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
