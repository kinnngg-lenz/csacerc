@extends('layouts.app')
@section('title', 'Ask Question')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ask a Question</div>
                    <div class="panel-body">

                        {{ Form::open(['class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                            {{ Form::label('question', 'Question Here', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::textarea('question',null,['class' => 'form-control', 'placeholder' => 'Your question goes here...']) }}
                                <div class="text-info small">Github flavored <a class="text-info" target="_blank" href="https://guides.github.com/features/mastering-markdown/"><b>Markdown</b></a> supported</div>
                            @if ($errors->has('question'))
                            <span class="help-block">
                            <strong>{{ $errors->first('question') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('asker') ? ' has-error' : '' }}">
                            {{ Form::label('asker', 'Asker', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('asker',Auth::user()->name,['class' => 'form-control', 'disabled' => 'true']) }}
                            @if ($errors->has('asker'))
                            <span class="help-block">
                            <strong>{{ $errors->first('asker') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('asking_to') ? ' has-error' : '' }}">
                            {{ Form::label('asking_to', 'Asking To', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('asking_to',null,['class' => 'form-control formsearch', 'autocomplete' => 'off', 'placeholder' => 'Username or Email only']) }}
                                <div class="text-info small">Leave blank if asking Globally</div>
                            @if ($errors->has('asking_to'))
                            <span class="help-block">
                            <strong>{{ $errors->first('asking_to') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
                            {{ Form::label('public', 'Visibility', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('public', array('1' => 'Yes! Make this visible to everybody', '0' => 'No! Don\'t wanna this to be visible'), null, ['placeholder' => 'Make this visible to Questions section?', 'class' => 'form-control']) }}
                                <div class="text-info small"></div>
                                @if ($errors->has('public'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('', 'Terms', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            <p class="text-warning"><i>Question you gonna ask must not be related to anything personal. Your question will be reviewed by a moderator before it goes live.</i></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Ask this Question', ['class' => 'btn btn-info']) }}
                                {{ Form::reset('Reset Form', ['class' => 'btn btn-warning']) }}
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
