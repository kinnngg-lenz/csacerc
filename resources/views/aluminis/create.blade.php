@extends('layouts.app')
@section('title', "Create Alumini")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create an Alumini</div>
                    <div class="panel-body">

                        {{ Form::open(['files' => 'true', 'class' => 'form-horizontal']) }}

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
                            {{ Form::label('facebook', 'Facebook Profile Url (if any)', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                            {{ Form::text('facebook',null,['class' => 'form-control']) }}
                            @if ($errors->has('facebook'))
                            <span class="help-block">
                            <strong>{{ $errors->first('facebook') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {{ Form::label('photo', 'Alumini\'s Photo', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::file('photo',null,['class' => 'form-control']) }}
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Submit Alumini', ['class' => 'btn btn-info']) }}
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
