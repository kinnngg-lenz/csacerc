@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create an Event</div>
                    <div class="panel-body">

                        {{ Form::open(['files' => 'true', 'class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Event Name', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('name',null,['class' => 'form-control']) }}
                            @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            {{ Form::label('date', 'Event Date', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::date('date',null,['class' => 'form-control']) }}
                            @if ($errors->has('date'))
                            <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
                            {{ Form::label('venue', 'Event Venue', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('venue',null,['class' => 'form-control']) }}
                            @if ($errors->has('venue'))
                            <span class="help-block">
                            <strong>{{ $errors->first('venue') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {{ Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::textarea('description',null,['class' => 'form-control']) }}
                            @if ($errors->has('description'))
                            <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {{ Form::label('photo', 'Poster', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::file('photo',null,['class' => 'form-control']) }}
                            @if ($errors->has('photo'))
                            <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Submit Event', ['class' => 'btn btn-info']) }}
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
