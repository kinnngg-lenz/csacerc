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


                        <div class="form-group{{ $errors->has('batch') ? ' has-error' : '' }}">
                            {{ Form::label('batch', 'Your Batch:', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('batch', [
                                '2000-2004' => '2000-2004',
                                '2001-2005' => '2001-2005',
                                '2002-2006' => '2002-2006',
                                '2003-2007' => '2003-2007',
                                '2004-2008' => '2004-2008',
                                '2005-2009' => '2005-2009',
                                '2006-2010' => '2006-2010',
                                '2007-2011' => '2007-2011',
                                '2008-2012' => '2008-2012',
                                '2009-2013' => '2009-2013',
                                '2010-2014' => '2010-2014',
                                '2011-2015' => '2011-2015',
                                '2012-2016' => '2012-2016',
                                '2013-2017' => '2013-2017',
                                '2014-2018' => '2014-2018',
                                '2015-2019' => '2015-2019',
                                '2016-2020' => '2016-2020',
                                ], null, ['placeholder' => 'No Batch', 'class' => 'form-control', 'disabled' => 'true']) }}
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
                                <i class="text-warning">Updating profile picture not available at this moment. It will be made available Asap but if its urgent please contact Admin.
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