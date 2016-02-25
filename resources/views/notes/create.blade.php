@extends('layouts.app')
@section('title', 'Create News')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Notes</div>
                    <div class="panel-body">

                        {{ Form::open(['files' => 'true', 'class' => 'form-horizontal']) }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Name:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Title of note. eg: Advanced Data Structure']) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Belonging College</label>
                            <div class="col-md-6">
                                {{ Form::select('college_id', App\College::lists('name','id'), null, ['placeholder' => 'Select belonging college..', 'class' => 'form-control', 'id' => "inputType"]) }}
                                @if ($errors->has('college_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('college_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Belonging Department:</label>
                            <div class="col-md-6">
                                {{ Form::select('department_id', App\Department::lists('name','id'), null, ['placeholder' => 'Select best fit department..', 'class' => 'form-control']) }}
                                @if ($errors->has('department_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Semester:</label>
                            <div class="col-md-6">
                                {{ Form::select('semester', ['0' => 'All Semester', '1' => '1st Semester' ,'2' => '2nd Semester' ,'3' => '3rd Semester' ,'4' => '4th Semester', '5' => '5th Semester', '7' => '7th Semester', '8' => '8th Semester'], null, ['placeholder' => 'Select sem this note belongs to..', 'class' => 'form-control']) }}
                                @if ($errors->has('semester'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('semester') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                            {{ Form::label('owner', 'Owner Name:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('owner',null,['class' => 'form-control']) }}
                            @if ($errors->has('owner'))
                            <span class="help-block">
                            <strong>{{ $errors->first('owner') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            {{ Form::label('file', 'Notes File (pdf)', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::file('file',null,['class' => 'form-control']) }}
                                @if ($errors->has('file'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Submit Notes', ['class' => 'btn btn-info']) }}
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
