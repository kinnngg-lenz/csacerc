@extends('layouts.app')
@section('title', str_limit($question->question,50)." (Question)")
@section('styles')
    <style>
        footer
        {
            margin-top: 50px;
        }
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
        .List
        {
            display: inline-block;
            margin: 0;
            padding: 0;
            margin-left: 10px;
            color: #c5c5c5;
        }
        .post-like-button
        {
            vertical-align: middle;
        }
        .label.label-info
        {
            padding: 5px;
            margin-left: 5px;
            color: #c5c5c5;
        }
        .label.label-info a
        {
            color: white;
        }
        .well.well-sm
        {
            border: 1px solid #e9e9e9;
        }
        .well.well-sm.question-well
        {
            border: 1px solid #845574;
            background: transparent;
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

                <div class="likes well well-sm question-well">
                    {{ Form::open(['route' => ['questions.question.likes.post',$question->id], 'class' => 'like-reply-form']) }}
                    @if(Auth::check())
                        @if($question->likes()->where('user_id', Auth::user()->id)->get()->isEmpty())
                            <button title="Like it" type="submit" class="btn btn-info btn-sm post-like-button">
                                <i class="fa fa-thumbs-up"></i> <sub>{{ $question->likes->count() }}</sub>
                            </button>
                        @else
                            <button title="Unlike it" type="submit" class="btn btn-danger btn-sm post-like-button">
                                <i class="fa fa-thumbs-down"></i> <sub>{{ $question->likes->count() }}</sub>
                            </button>
                        @endif
                    @else
                        <button class="btn btn-default disabled btn-sm post-like-button">
                            <i class="fa fa-thumbs-up"></i> <sub>{{ $question->likes->count() }}</sub>
                        </button>
                    @endif
                    <ul class="likes List">
                        @foreach($question->likes()->limit(7)->get() as $like)
                            <li class="label label-info">
                                {{ link_to_route('users.profile.show',$like->user->username,$like->user->username) }}
                            </li>
                        @endforeach
                    </ul>
                    {{ Form::close() }}
                </div>

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
                        <p class="text-center"><i class='text-danger'>Not answered yet!</i></p>
                        @endcan
                        @else
                            <div class="padding10 panel">
                                {!! render_markdown_for_view($question->answer) !!}
                            </div>
                        @endif

                        @include('partials.disqus')

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