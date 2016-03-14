@extends('layouts.app')
@section('title', $question->title." (CodeWar)")
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
            {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Question Viewer</h3></div>--}}

            <div class="jumbotron">
                <h1>{{ $question->title }}</h1>
                @unless(is_null($question->description) || empty($question->description))
                    <div class="padding10">{!! (render_markdown_for_view($question->description)) !!}</div>
                @endunless
                <p class="text-muted blockquote-reverse">
                    Started {{  $question->created_at->diffForHumans()}}
                </p>
                @if($question->ends_at == null)
                    <p class="blockquote-reverse">No End Time</p>
                @elseif($question->ends_at < Carbon\Carbon::now())
                    <p class="blockquote-reverse text-danger">War has Ended {{ $question->ends_at->diffForHumans() }}</p>
                @else
                    <p class="blockquote-reverse">
                        <span class="counter"></span><br>
                        <i><span class="tiny text-muted">( Ends approx {{ $question->ends_at->diffForHumans() }}
                                )</span></i>
                    </p>
                @endif

                <div class="likes well well-sm question-well">
                    {{ Form::open(['route' => ['codewar.question.likes.post',$question->id], 'class' => 'like-reply-form']) }}
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

                @can('edit', $question)
                {{ link_to_route('codewar.edit', 'Edit War', [$question->id], ['class' => 'pull-right btn btn-info btn-sm']) }}
                @endcan

            </div>

            <div class="container">
                        @can('edit',$answer)
                        {{ Form::model($answer,['method' => 'patch','route' => ['codewar.answer.update',$question->id,$answer->id],'class' => 'form-horizontal']) }}
                        <div class="row form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                            <div class="col-md-2 hidden-xs hidden-sm">
                                <img class="img-thumbnail col-md-9" src="/images/{{ $answer->user->getProfilePicUrl() }}" alt="Profile" style="">
                            </div>
                            <div class="col-md-10">
                                {{ Form::textarea('answer',null,['class' => 'form-control', 'rows' => '4','required']) }}
                                <div class="text-info small text-right">
                                    Github flavored <a class="text-info" target="_blank" href="https://guides.github.com/features/mastering-markdown/"><b>Markdown</b></a> supported
                                </div>
                                <br>
                                @if ($errors->has('answer'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('answer') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        {{ Form::hidden('code_war_question_id',$question->id) }}
                        {{ Form::hidden('code_war_answer_id',$answer->id) }}
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-2">
                                {{ Form::submit('Update Answer', ['class' => 'btn btn-info btn-block']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                        @endcan
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

    @if($question->ends_at != null && $question->ends_at > Carbon\Carbon::now())
        <script type="text/javascript">
            $('.counter').countdown(count_down, function (event) {
                var $this = $(this).html(event.strftime(''
                        + '<span>%w</span>w '
                        + '<span>%d</span>d '
                        + '<span>%H</span>h '
                        + '<span>%M</span>m '
                        + '<span>%S</span>s'));
            });
        </script>
    @endif
@endsection