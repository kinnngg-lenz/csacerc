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
                @forelse($question->answers()->latest()->get() as $answer)
                    <div class="row">
                        <div class="col-md-2 hidden-xs hidden-sm">
                            <img class="img img-thumbnail" src="/images/{{ $answer->user->getProfilePicUrl() }}" style="width:200px;">
                            <div class="text-center">
                                <h4>{{ link_to_route('users.profile.show',$answer->user->name,$answer->user->username) }}</h4>
                                <p class="text-muted">{{ $answer->created_at->diffForHumans() }}</p>
                                @if($question->best_answer_id == $answer->id && $question->ends_at <= \Carbon\Carbon::now())
                                    <h3><span class="label label-success">Winner</span></h3>
                                @endif
                            </div>
                        </div>
                    <div class="panel col-md-10">

                        <p class="padding10 visible-xs">
                            <b>{{ link_to_route('users.profile.show',$answer->user->name,$answer->user->username) }}</b>
                             - <span class="text-muted small">{{ $answer->created_at->diffForHumans() }}</span>
                        @if($question->best_answer_id == $answer->id && $question->ends_at <= \Carbon\Carbon::now())
                            <span class="padding10 visible-xs"><span class="label label-success">Winner</span></span>
                        @endif
                        </p>

                        <div class="padding10">{!! render_markdown_for_view($answer->answer) !!}</div>
                        <p class="">
                            @can('edit', $question)
                            @unless($question->best_answer_id == $answer->id)
                                {{ Form::open(['route' => ['codewar.bestanswer', $question->id],'method' => 'patch']) }}
                                {{ Form::hidden('best_answer_id', $answer->id) }}
                                {{ Form::submit('Set as Winner', ['class' => 'btn btn-success btn-sm']) }}
                                {{ Form::close() }}
                                @else
                                    {{ Form::open() }}
                                    {{ Form::submit('Selected as Winner', ['class' => 'btn btn-warning btn-sm', 'disabled' => 'true']) }}
                                    {{ Form::close() }}
                                    @endunless
                            @endcan
                        </p>

                        <div class="likes well well-sm">
                               {{ Form::open(['route' => ['codewar.likes.post',$question->id,$answer->id], 'class' => 'like-reply-form']) }}
                               @if(Auth::check())
                                    @if($answer->likes()->where('user_id', Auth::user()->id)->get()->isEmpty())
                                    <button title="Like it" type="submit" class="btn btn-info btn-sm post-like-button">
                                    <i class="fa fa-thumbs-up"></i> <sub>{{ $answer->likes->count() }}</sub>
                                    </button>
                                    @else
                                    <button title="Unlike it" type="submit" class="btn btn-danger btn-sm post-like-button">
                                    <i class="fa fa-thumbs-down"></i> <sub>{{ $answer->likes->count() }}</sub>
                                    </button>
                                    @endif
                                @else
                                <button class="btn btn-default disabled btn-sm post-like-button">
                                    <i class="fa fa-thumbs-up"></i> <sub>{{ $answer->likes->count() }}</sub>
                                </button>
                                @endif
                                <ul class="likes List">
                                    @foreach($answer->likes()->limit(7)->get() as $like)
                                    <li class="label label-info">
                                        {{ link_to_route('users.profile.show',$like->user->username,$like->user->username) }}
                                    </li>
                                    @endforeach
                                </ul>
                                {{ Form::close() }}
                        </div>

                    </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-md-2"></div>
                    <div class="col-md-10 well">
                        <div class='padding10 text-danger'><i><b>Nobody has approached this war yet</b> </i>
                        </div>
                    </div>
                    </div>
                @endforelse


                @if($question->isOpen())
                    @if(Auth::check())
                        @if(is_null($question->answers()->where('user_id',Auth::user()->id)->first()))
                            {{ Form::open(['class' => 'form-horizontal']) }}
                            <div class="row form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                <div class="col-md-2 hidden-xs hidden-sm">
                                    <img class="img-thumbnail col-md-9" src="/images/{{ Auth::user()->getProfilePicUrl() }}" alt="Profile" style="">
                                </div>
                                <div class="col-md-10">
                                    {{ Form::textarea('answer',null,['class' => 'form-control', 'rows' => '4']) }}
                                    <div class="text-info small text-right">
                                        Github flavored <a class="text-info" target="_blank" href="https://guides.github.com/features/mastering-markdown/"><b>Markdown</b></a> supported
                                    </div>
                                    <br>
                                    <i class="text-danger"><b>Note:</b> Please review your answer before posting, it can
                                        only be submitted once per war.</i>
                                    @if ($errors->has('answer'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('answer') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            {{ Form::hidden('code_war_question_id',$question->id) }}
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-2">
                                    {{ Form::submit('Submit Your Answer', ['class' => 'btn btn-info btn-block']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        @else
                            {{ Form::open(['method' => 'get','class' => 'form-horizontal']) }}
                            <div class="row form-group{{ $errors->has('disabled') ? ' has-error' : '' }}">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    {{ Form::textarea('disabled',null,['class' => 'form-control', 'placeholder' => 'You have already attempted this War', 'rows' => '3', 'disabled' => 'true']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        @endif

                    @else
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10 well">
                                <div class='panel padding10 text-muted'><b>Please {{ link_to('/login','Login') }}
                                        or {{ link_to('/register', 'Register') }} to participate.</b></div>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- War is Over --}}
                @endif

                @include('partials.disqus')

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