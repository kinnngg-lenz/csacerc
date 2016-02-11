@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Question Viewer</h3></div>--}}
                @can('edit', $question)
                <div class="col-md-12 text-right">
                        {{ link_to_route('codewar.edit', 'Edit War', [$question->id], ['class' => 'btn btn-danger btn-sm']) }}
                </div>
                @endcan

                <div class="col-md-11 well" style="background: #DDE8F6">
                    <h4>{{ $question->title }}</h4>
                    @unless(is_null($question->description) || empty($question->description))
                        <div class="panel padding10">{!! (render_markdown_for_view($question->description)) !!}</div>
                    @endunless

                    <p class="blockquote-reverse">
                        <span class="text-small">{{ link_to_route('codewar.show', $question->created_at->diffForHumans(), $question->slug) }}
                            <br></span>
                    </p>
                </div>

                @forelse($question->answers as $answer)
                    <div class="well col-md-11" {!! $question->best_answer_id == $answer->id ? "style='background: #D2F2D2'" : "" !!}>
                        <div class="panel padding10">{!! render_markdown_for_view($answer->answer) !!}</div>
                        <p class="blockquote-reverse">
                            <span class="text-small">{{ link_to_route('users.profile.show',$answer->user->name,[$answer->user->username]) }}</span>
                            <br>
                            <span class="text-small">{{ $answer->created_at->diffForHumans() }}</span>
                        </p>
                    </div>
                @empty
                    <div class="col-md-11 well">
                        <div class='panel padding10 text-danger'><i><b>Nobody has dared to approach this War</b> </i>
                        </div>
                    </div>
                @endforelse

                @if($question->isOpen())
                    @if(Auth::check())
                        @if(is_null($question->answers()->where('user_id',Auth::user()->id)->first()))
                            {{ Form::open(['class' => 'form-horizontal']) }}
                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                <div class="col-md-11">
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
                                <div class="col-md-11">
                                    {{ Form::submit('Submit Your Answer', ['class' => 'btn btn-info']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        @else
                            {{ Form::open(['method' => 'get','class' => 'form-horizontal']) }}
                            <div class="form-group{{ $errors->has('disabled') ? ' has-error' : '' }}">
                                <div class="col-md-11">
                                {{ Form::textarea('disabled',null,['class' => 'form-control', 'placeholder' => 'You have already attempted this War', 'rows' => '3', 'disabled' => 'true']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        @endif
                        
                    @else
                        <div class="col-md-11 well">
                            <div class='panel padding10 text-muted'><b>Please {{ link_to('/login','Login') }}
                                    or {{ link_to('/register', 'Register') }} to participate.</b></div>
                        </div>
                    @endif
                @else
                    <div class="col-md-11 well">
                        <div class='panel padding10 text-info'><i><b>This War is Over!</b> </i></div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    </div>
@endsection
