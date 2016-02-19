@extends('layouts.app')
@section('title', "Create Alumini")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create an Alumini</div>
                    <div class="panel-body">

                        {{ Form::open(['class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('speaker') ? ' has-error' : '' }}">
                            {{ Form::label('speaker', 'Speaker\'s Name', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('speaker',null,['class' => 'form-control']) }}
                            @if ($errors->has('speaker'))
                            <span class="help-block">
                            <strong>{{ $errors->first('speaker') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('batch') ? ' has-error' : '' }}">
                            {{ Form::label('batch', 'Speaker\'s Batch', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('batch',null,['class' => 'form-control']) }}
                            @if ($errors->has('batch'))
                            <span class="help-block">
                            <strong>{{ $errors->first('batch') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profession') ? ' has-error' : '' }}">
                            {{ Form::label('profession', 'Speaker\'s Profession', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('profession',null,['class' => 'form-control']) }}
                            @if ($errors->has('profession'))
                            <span class="help-block">
                            <strong>{{ $errors->first('profession') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('speech') ? ' has-error' : '' }}">
                            {{ Form::label('speech', 'Speech', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::textarea('speech',null,['class' => 'form-control']) }}
                            @if ($errors->has('speech'))
                            <span class="help-block">
                            <strong>{{ $errors->first('speech') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Submit Alumini', ['class' => 'btn btn-info']) }}
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
