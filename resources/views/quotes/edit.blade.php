@extends('layouts.app')
@section('title', "Edit Quote : ".$quote->text)
@section('styles')
    <style>
        .width10
        {
            width:10% !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Quote</div>
                    <div class="panel-body">

                        {{ Form::model($quote,['class' => 'form-horizontal', 'method' => 'patch']) }}

                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            {{ Form::label('text', 'Quote Text', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('text',null,['class' => 'form-control', 'placeholder' => 'Quote text. Recommended not much long for UI, eg: I have not failed. I\'ve just found 10,000 ways that won\'t work. ']) }}
                                @if ($errors->has('text'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('text') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('speaker') ? ' has-error' : '' }}">
                            {{ Form::label('speaker', 'Speaker\'s Name', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('speaker',null,['class' => 'form-control', 'placeholder' => 'Speaker. eg: Thomas Edison ']) }}
                                @if ($errors->has('speaker'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('speaker') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        @if(Auth::user()->isSuperAdmin())
                            <div class="form-group{{ $errors->has('approved') ? ' has-error' : '' }}">
                                {{ Form::label('approved', 'Approved for dashboard', ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                {{ Form::checkbox('approved',null,null,['class' => 'form-control width10']) }}
                                @if ($errors->has('approved'))
                                <span class="help-block">
                                <strong>{{ $errors->first('approved') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Create Quotes', ['class' => 'btn btn-info']) }}
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
