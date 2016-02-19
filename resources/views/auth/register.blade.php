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
        pre
        {
            padding: 0px;
        }
        h1 {
            font-size: 300% !important;
        }
        .tiny {
            font-size: 14px;
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <select name="gender" class="form-control" id="inputGender">
                                    <option value="" class="text-muted">Select Gender</option>
                                    <option value="Female" {{ (old("gender") == "Female" ? "selected":"") }}>Female</option>
                                    <option value="Male" {{ (old("gender") == "Male" ? "selected":"") }}>Male</option>
                                    <option value="Others" {{ (old("gender") == "Others" ? "selected":"") }}>Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">You Are?</label>
                            <div class="col-md-6">
                                <select name="type" class="form-control" id="inputType">
                                    <option value="" class="text-muted">Select Account</option>
                                    <option value="0" {{ (old("type") == "0" ? "selected":"") }}>A Student</option>
                                    <option value="1" {{ (old("type") == "1" ? "selected":"") }}>Faculty Member</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('college') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Your College</label>
                            <div class="col-md-6">
                                <select name="college" class="form-control" id="inputType">
                                    <option value="" class="text-muted">Select College</option>
                                    <option value="1" {{ (old("college") == "1" ? "selected":"") }}>
                                        ARYA College of Engg & Research Center
                                    </option>
                                    <option value="2" {{ (old("college") == "2" ? "selected":"") }}>
                                        ARYA Institute of Engg & Technology
                                    </option>
                                    <option value="3" {{ (old("college") == "3" ? "selected":"") }}>
                                        ARYA Institute of Engg Tech & Management
                                    </option>
                                    <option value="4" {{ (old("college") == "4" ? "selected":"") }}>
                                        ARYA College of Pharmacy
                                    </option>
                                    <option value="6" {{ (old("college") == "6" ? "selected":"") }}>
                                        Others
                                    </option>
                                    <option value="0" {{ (old("college") == "0" ? "selected":"") }}>
                                        None
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                <select name="department" class="form-control" id="inputType">
                                    <option value="" class="text-muted">Select Department</option>
                                    <option value="1" {{ (old("department") == "1" ? "selected":"") }}>
                                        Dept of Computer Science
                                    </option>
                                    <option value="2" {{ (old("department") == "2" ? "selected":"") }}>
                                        Dept for 1st Year
                                    </option>
                                    <option value="3" {{ (old("department") == "3" ? "selected":"") }}>
                                        Dept of Civil Engg.
                                    </option>
                                    <option value="4" {{ (old("department") == "4" ? "selected":"") }}>
                                        Dept of Electrical Engg.
                                    </option>
                                    <option value="5" {{ (old("department") == "5" ? "selected":"") }}>
                                        Dept of Mechanical Engg.
                                    </option>
                                    <option value="6" {{ (old("department") == "6" ? "selected":"") }}>
                                        Others
                                    </option>
                                    <option value="0" {{ (old("department") == "0" ? "selected":"") }}>
                                        None
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
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
