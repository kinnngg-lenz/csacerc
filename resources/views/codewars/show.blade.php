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
            {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Question Viewer</h3></div>--}}
            @can('edit', $question)
            <div class="col-md-12 text-right">
                {{ link_to_route('codewar.edit', 'Edit War', [$question->id], ['class' => 'btn btn-danger btn-sm']) }}
            </div>
            @endcan

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
            </div>

            <div class="container">
                @forelse($question->answers()->latest()->get() as $answer)
                    <div class="row">
                        <div class="col-md-2 hidden-xs hidden-sm">
                            <img class="img-thumbnail" src="/images/static/{{ $answer->user->gender }}.jpeg" alt="">
                            <div class="text-center">
                                <h4>{{ link_to_route('users.profile.show',$answer->user->name,$question->user->username) }}</h4>
                                <p class="text-muted">{{ $answer->created_at->diffForHumans() }}</p>
                                @if($question->best_answer_id == $answer->id && $question->ends_at <= \Carbon\Carbon::now())
                                    <h3><span class="label label-success">Winner</span></h3>
                                @endif
                            </div>
                        </div>
                    <div class="panel col-md-10">

                        <p class="padding10 visible-xs">
                            <b>{{ link_to_route('users.profile.show',$answer->user->name,$question->user->username) }}</b>
                             - <span class="text-muted small">{{ $answer->created_at->diffForHumans() }}</span>
                        @if($question->best_answer_id == $answer->id && $question->ends_at <= \Carbon\Carbon::now())
                            <span class="padding10 visible-xs"><span class="label label-success">Winner</span></span>
                        @endif
                        </p>

                        <div class="padding10">{!! render_markdown_for_view($answer->answer) !!}</div>
                        <p class="blockquote-reverse">
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
                    </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-md-2"></div>
                    <div class="col-md-10 well">
                        <div class='padding10 text-danger'><i><b>Nobody has dared to approach this War</b> </i>
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
                                    <img class="img-thumbnail col-md-9" src="/images/static/{{ Auth::user()->gender }}.jpeg" alt="">
                                </div>
                                <div class="col-md-10">
                                    {{ Form::textarea('answer',null,['class' => 'form-control', 'rows' => '4']) }}
                                    <div class="text-info small text-right">
                                        Github flavored <b>Markdown</b> supported
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


            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
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