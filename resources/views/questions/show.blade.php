@extends('layouts.app')

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
            <div class="jumbotron">
                <h3 class="padding10">{!! (render_markdown_for_view($question->question)) !!}</h3>
                <p class="text-muted blockquote-reverse">
                    Asked {{  $question->created_at->diffForHumans()}}
                </p>
            </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @if(is_null($question->answer))
                        @can('answer', $question)
                        {{ Form::open(['method' => 'patch', 'class' => 'form-horizontal']) }}
                        <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                            <div class="col-md-12">
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
                        <p class="text-center"><i class='text-danger'>No answered yet!</i></p>
                        @endcan
                        @else
                            <div class="padding10 panel">{!! render_markdown_for_view($question->answer) !!}</div>
                        @endif
                </div>
                </div>
            </div>
@endsection
