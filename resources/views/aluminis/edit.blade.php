@extends('layouts.app')
@section('title', "Edit Alumini of ".$alumini->speaker)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Alumini of {{ $alumini->speaker }}</div>
                    <div class="panel-body">

                        {{ Form::model($alumini,['files' => 'true', 'class' => 'form-horizontal','method' => 'patch']) }}

                        <div class="form-group{{ $errors->has('speaker') ? ' has-error' : '' }}">
                            {{ Form::label('speaker', 'Alumini\'s Name', ['class' => 'col-md-4 control-label']) }}
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
                            {{ Form::label('batch', 'Alumini\'s Batch', ['class' => 'col-md-4 control-label']) }}
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
                                    ], null, ['placeholder' => 'Select Batch..', 'class' => 'form-control']) }}
                                @if ($errors->has('batch'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('batch') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                {{ Form::select('department_id', App\Department::lists('name','id'), null, ['placeholder' => 'Select belonging Department..', 'class' => 'form-control']) }}
                                @if ($errors->has('department_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profession') ? ' has-error' : '' }}">
                            {{ Form::label('profession', 'Alumini\'s Profession', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('profession',null,['class' => 'form-control']) }}
                                @if ($errors->has('profession'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('profession') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('organisation_id') ? ' has-error' : '' }}">
                            {{ Form::label('organisation_id', 'Company (if any)', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('organisation_id', App\Organisation::lists('name','id'), null, ['placeholder' => 'Select Organisation..', 'class' => 'form-control', 'id' => "inputType"]) }}
                                <div class="text-info small">If the company of alumini is not listed then please add by
                                    <b>{{ link_to_route('org.create','clicking here') }}</b>
                                </div>
                                @if ($errors->has('organisation_id'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('organisation_id') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Email Address', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('email',null,['class' => 'form-control']) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                            {{ Form::label('facebook', 'Facebook Username (if any)', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('facebook',null,['class' => 'form-control']) }}
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
                                {{ Form::textarea('speech',null,['class' => 'form-control']) }}
                                @if ($errors->has('speech'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('speech') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {{ Form::label('photo', 'Alumini\'s photo', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                <img style="margin-bottom:5px;border: 1px solid grey" class="img" src="/image/{{ $alumini->getPhoto() }}/thumbnail/100" alt="" width="100" height="100">
                                {{ Form::file('photo',null,['class' => 'form-control']) }}
                                <i class="small text-info">Leave empty if you don't want to change.</i>
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            {{ Form::label('user_id', 'Ownership', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::select('user_id',App\User::lists('name','id'),null,['class' => 'form-control']) }}
                            @if(!Auth::user()->isAdmin())
                                <i class="small text-warning">Warning: After transfer of ownership you will not be able to control this alumini profile</i>
                            @endif
                            @if ($errors->has('user_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('user_id') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Update Alumini', ['class' => 'btn btn-info']) }}
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
