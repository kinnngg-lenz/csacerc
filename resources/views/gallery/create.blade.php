@extends('layouts.app')
@section('title', 'Add Picture to Gallery')
@section('styles')
    <style>
        footer
        {
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Image to Gallery</div>
                    <div class="panel-body">

                        {{ Form::open(['files' => 'true', 'class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {{ Form::label('photo', 'Image', ['class' => 'col-md-4 control-label']) }}
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
                                {{ Form::submit('Add Image', ['class' => 'btn btn-info']) }}
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
