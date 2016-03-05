@extends('layouts.app')
@section('title', 'Add organisation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Organisation/Company</div>
                    <div class="panel-body">

                        {{ Form::open(['files' => 'true', 'class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Organisation Name <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                            {{ Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Full name of Organisation']) }}
                            @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('initials') ? ' has-error' : '' }}">
                            {{ Form::label('initials', 'Short Name', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('initials',null,['class' => 'form-control', 'placeholder' => 'Any Shortname or Initials']) }}
                            @if ($errors->has('initials'))
                            <span class="help-block">
                            <strong>{{ $errors->first('initials') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                            {{ Form::label('details', 'Details', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('details',null,['class' => 'form-control', 'placeholder' => 'Few lines about this Organisation']) }}
                                @if ($errors->has('details'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('details') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            {{ Form::label('address', 'Address of Office', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('address',null,['class' => 'form-control', 'placeholder' => 'Any Address of Org.']) }}
                            @if ($errors->has('address'))
                            <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {{ Form::label('photo', 'Logo', ['class' => 'col-md-4 control-label']) }}
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
                                {{ Form::submit('Add Organisation', ['class' => 'btn btn-info']) }}
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
