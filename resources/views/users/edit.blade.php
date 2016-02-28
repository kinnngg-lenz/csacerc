@extends('layouts.app')
@section('title', 'Setting')
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

                        <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
                            {{ Form::label('college_id', 'College:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('college_id', App\College::lists('name', 'id'), null, ['placeholder' => 'Select your College..', 'class' => 'form-control']) }}
                                @if ($errors->has('college_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('college_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            {{ Form::label('department_id', 'Department:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('department_id', App\Department::lists('name', 'id'), null, ['placeholder' => 'Select your Department..', 'class' => 'form-control']) }}
                                @if ($errors->has('department_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
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
                            {{ Form::label('none', 'Profile Picture', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                <i class="text-info">To change your profile picture you need to signup/login at <a target="_blank" href="//gravatar.com">gravatar.com</a> with email <span
                                            class="text-pink">{{ Auth::user()->email }}</span> and upload a picture
                                    there.
                                </i>
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