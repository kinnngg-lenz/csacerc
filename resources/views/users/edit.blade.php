@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Profile</div>

                    <div class="panel-body">
                        {{ Form::model($user,['class' => 'form-horizontal']) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', 'Full Name:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('name',null,['class' => 'form-control']) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {{ Form::label('username', 'Username:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('username',null,['class' => 'form-control', 'disabled' => 'true']) }}
                                @if ($errors->has('username'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            {{ Form::label('type', 'You Are:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('type', array('0' => 'A Student', '1' => 'Faculty Member'), null, ['placeholder' => 'Select Account Type...', 'class' => 'form-control', 'disabled' => 'true']) }}
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('college') ? ' has-error' : '' }}">
                            {{ Form::label('college', 'College:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('college', array(
                                '1' => 'ARYA College of Engg & Research Center',
                                '2' => 'ARYA Institute of Engg & Technology',
                                '3' => 'ARYA Institute of Engg Tech & Management',
                                '4' => 'ARYA College of Pharmacy',
                                '6' => 'Others',
                                '0' => 'None'
                                ), null, ['placeholder' => 'Select College', 'class' => 'form-control']) }}
                                @if ($errors->has('college'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('college') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            {{ Form::label('department', 'Department:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('department', array(
                                '1' => 'Dept of Computer Science',
                                '2' => 'Dept for 1st Year',
                                '3' => 'Dept of Civil Engg.',
                                '4' => 'Dept of Electrical Engg.',
                                '5' => 'Dept of Mechanical Engg.',
                                '6' => 'Others',
                                '0' => 'None'
                                ), null, ['placeholder' => 'Select Department', 'class' => 'form-control']) }}
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            {{ Form::label('dob', 'Date of Birth:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">

                                    <div id="datetimepicker1" class="input-group">
                                        {{ Form::text('dob', null, ['class' => 'form-control', 'data-format' => 'yyyy-MM-dd']) }}
                                        <span class="add-on input-group-btn">
                                            <button class="btn btn-info">
                                        <i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar">
                                        </i>
                                            </button>
                                        </span>
                                    </div>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            {{ Form::label('about', 'About Me:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('about',null,['class' => 'form-control']) }}
                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Update Profile', ['class' => 'btn btn-primary']) }}
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
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                language: 'en',
                pickTime: false
            });
        });
    </script>
@endsection