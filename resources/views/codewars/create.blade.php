@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Start a new Code War</div>
                    <div class="panel-body">

                        {{ Form::open(['class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {{ Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('title',null,['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'eg: Wap to find palindrome using C++']) }}
                                <div class="text-info small">Not more than 250 characters</div>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {{ Form::label('description', 'Full Description', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('description',null,['class' => 'form-control', 'placeholder' => 'Describe your War here...']) }}
                                <div class="text-info small">Github flavored <b>Markdown</b> supported</div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ends_at') ? ' has-error' : '' }}">
                            {{ Form::label('ends_at', 'War End Time', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{-- @TODO: Replace this with Datetime selector plugin--}}

                            {{ Form::date('ends_at',null,['class' => 'form-control']) }}
                            <div class="text-info small">Leave blank for no end time</div>
                            @if ($errors->has('ends_at'))
                                <span class="help-block">
                            <strong>{{ $errors->first('ends_at') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit('Start War', ['class' => 'btn btn-info']) }}
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

@section('scripts')

@endsection