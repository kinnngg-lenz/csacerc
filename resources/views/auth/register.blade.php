@extends('layouts.app')
@section('title', "Register")
@section('styles')
    <style>
        .jumbotron {
            background: url('/images/static/head.png') #573e81;
            margin-top: -28px;
            border-radius: 0px !important;
            color: white;
        }

        .jumbotron pre {
            padding: 0px;
            border: none;
            border-radius: 0px;
        }

        pre {
            padding: 0px;
        }

        h1 {
            font-size: 300% !important;
        }

        .tiny {
            font-size: 14px;
        }

        .width10 {
            width: 10% !important;
        }

        .select2.select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>Register</h1>
                <p class="">Register now for a new account and get started!</p>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                              action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Full Name <span class="text-danger">*</span> </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                           placeholder="firstname middlename lastname">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           placeholder="a valid email address">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Username <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username"
                                           value="{{ old('username') }}" placeholder="should match regex [a-zA-Z0-9_]">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Gender <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <select name="gender" class="form-control" id="inputGender">
                                        <option value="" class="text-muted">Select Gender</option>
                                        <option value="Female" {{ (old("gender") == "Female" ? "selected":"") }}>
                                            Female
                                        </option>
                                        <option value="Male" {{ (old("gender") == "Male" ? "selected":"") }}>Male
                                        </option>
                                        {{--<option value="Others" {{ (old("gender") == "Others" ? "selected":"") }}>Others</option>--}}
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">You Are <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <select name="type" class="form-control" id="inputType">
                                        <option value="" class="text-muted">Select Account</option>
                                        <option value="0" {{ (old("type") == "0" ? "selected":"") }}>A Student</option>
                                        <option value="1" {{ (old("type") == "1" ? "selected":"") }}>Faculty Member
                                        </option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('college_id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Your College <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    {{ Form::select('college_id', App\College::lists('name','id'), null, ['placeholder' => 'Select your College..', 'class' => 'form-control', 'id' => "inputType"]) }}
                                    @if ($errors->has('college_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('college_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Department <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    {{ Form::select('department_id', App\Department::lists('name','id'), null, ['placeholder' => 'Select your Department..', 'class' => 'form-control']) }}
                                    @if ($errors->has('department_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="group-batch form-group{{ $errors->has('batch') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Batch <span class="text-danger">*</span></label>
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
                                    ], null, ['placeholder' => 'Select your Batch..', 'class' => 'form-control']) }}
                                    @if ($errors->has('batch'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('batch') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password"
                                           placeholder="minimum 6 characters">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirm Password <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="repeat password">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                {{ Form::label('photo', 'Profile Picture', ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::file('photo',null,['class' => 'form-control']) }}
                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div id="alumini-cont" class="form-group{{ $errors->has('alumini') ? ' has-error' : '' }}">
                                {{ Form::label('alumini', 'Are you Alumini', ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::checkbox('alumini',null,false,['class' => 'form-control width10','id' => 'alumini']) }}
                                    @if ($errors->has('alumini'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('alumini') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form_alumini">

                                <div class="form-group{{ $errors->has('profession') ? ' has-error' : '' }}">
                                    {{ Form::label('profession', 'Alumini\'s Profession', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('profession',null,['class' => 'form-control', 'placeholder' => 'eg: Web Developer, IES Preparation, etc']) }}
                                        @if ($errors->has('profession'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('profession') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="org_select form-group{{ $errors->has('organisation_id') ? ' has-error' : '' }}">
                                    {{ Form::label('organisation_id', 'Company (if any)', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::select('organisation_id', App\Organisation::lists('name','id'), null, ['placeholder' => 'Select Organisation..', 'class' => 'form-control', 'id' => "inputType"]) }}
                                        <div class="text-info small">If the company you work in is not listed here then
                                            please help us and add the company you work with,
                                            <b>{{ link_to_route('org.create','click here') }}</b>
                                        </div>
                                        @if ($errors->has('organisation_id'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('organisation_id') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                    {{ Form::label('facebook', 'Facebook Profile Url (if any)', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('facebook',null,['class' => 'form-control', 'placeholder' => 'Full Url of Fb Profile']) }}
                                        @if ($errors->has('facebook'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('facebook') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('speech') ? ' has-error' : '' }}">
                                    {{ Form::label('speech', 'Speech (if any)', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::textarea('speech',null,['class' => 'form-control', 'placeholder' => 'eg: Anything you wanna say, news, techs, about yourself. etc']) }}
                                        @if ($errors->has('speech'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('speech') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-info btn-block">
                                        <i class="fa fa-btn fa-user"></i>Register Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        if ($('#alumini').is(':checked')) {
            $('.form_alumini').show();
        }
        else {
            $('.form_alumini').hide();
        }

        if($('#inputType').val() == 1){
            $('.group-batch').hide();
            $('#alumini-cont').hide();
            $('.form_alumini').hide();
        }
        else
        {
            $('.group-batch').show();
            $('#alumini-cont').show();
        }

        $(document).ready(function () {
            $('#inputType').change(function(){
                if($('#inputType').val() == 1){
                    $('.group-batch').hide();
                    $('#alumini-cont').hide();
                    $('.form_alumini').hide();
                }
                else
                {
                    if ($('#alumini').is(':checked')) {
                        $('.form_alumini').show();
                    }
                    else {
                        $('.form_alumini').hide();
                    }

                    $('.group-batch').show();
                    $('#alumini-cont').show();
                }
            });

            $('#alumini').click(function () {
                if ($(this).is(':checked')) {
                    $('.form_alumini').show();
                } else {
                    $('.form_alumini').hide();
                }
            });
        });
    </script>
@endsection