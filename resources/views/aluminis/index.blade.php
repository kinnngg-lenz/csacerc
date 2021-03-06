@extends('layouts.app')
@section('title', "Aluminis")
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
        .alumini-body
        {
            background-color: #0A3D3B;
            color: #FFFFFF !important;
        }
        .alumini-body .well
        {
            background: rgba(0, 0, 0, 0.38) !important;
            border: 1px solid #08201F !important;
        }
        .thumbnail
        {
            border: 7px solid #FAFAFA !important;
            -webkit-box-shadow: 1px 1px 6px 3px #D7D7D7;
            -moz-box-shadow: 1px 1px 6px 3px #D7D7D7;
            box-shadow: 1px 1px 6px 3px #D7D7D7;
            -o-box-shadow: 1px 1px 6px 3px #D7D7D7;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="jumbotron text-center">
                <h1>Aluminis of ARYA {{ Request::has('batch') ? "of batch ".Request::get('batch') : '' }}</h1>
                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        List Alumini by Batch <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="text-align: center;overflow:auto;height:300px;">
                        <li><a href="{{ route('alumini.index') }}">All</a></li>
                        <li class="{{ set_active_has('batch','2000-2004') }}"><a href="{{ route('alumini.index') }}?batch=2000-2004">2000 - 2004</a></li>
                        <li class="{{ set_active_has('batch','2001-2005') }}"><a href="{{ route('alumini.index') }}?batch=2001-2005">2001 - 2005</a></li>
                        <li class="{{ set_active_has('batch','2002-2006') }}"><a href="{{ route('alumini.index') }}?batch=2002-2006">2002 - 2006</a></li>
                        <li class="{{ set_active_has('batch','2003-2007') }}"><a href="{{ route('alumini.index') }}?batch=2003-2007">2003 - 2007</a></li>
                        <li class="{{ set_active_has('batch','2004-2008') }}"><a href="{{ route('alumini.index') }}?batch=2004-2008">2004 - 2008</a></li>
                        <li class="{{ set_active_has('batch','2005-2009') }}"><a href="{{ route('alumini.index') }}?batch=2005-2009">2005 - 2009</a></li>
                        <li class="{{ set_active_has('batch','2006-2010') }}"><a href="{{ route('alumini.index') }}?batch=2006-2010">2006 - 2010</a></li>
                        <li class="{{ set_active_has('batch','2007-2011') }}"><a href="{{ route('alumini.index') }}?batch=2007-2011">2007 - 2011</a></li>
                        <li class="{{ set_active_has('batch','2008-2012') }}"><a href="{{ route('alumini.index') }}?batch=2008-2012">2008 - 2012</a></li>
                        <li class="{{ set_active_has('batch','2009-2013') }}"><a href="{{ route('alumini.index') }}?batch=2009-2013">2009 - 2013</a></li>
                        <li class="{{ set_active_has('batch','2010-2014') }}"><a href="{{ route('alumini.index') }}?batch=2010-2014">2010 - 2014</a></li>
                        <li class="{{ set_active_has('batch','2011-2015') }}"><a href="{{ route('alumini.index') }}?batch=2011-2015">2011 - 2015</a></li>
                        <li class="{{ set_active_has('batch','2012-2016') }}"><a href="{{ route('alumini.index') }}?batch=2012-2016">2012 - 2016</a></li>
                        <li class="{{ set_active_has('batch','2013-2017') }}"><a href="{{ route('alumini.index') }}?batch=2013-2017">2013 - 2017</a></li>
                        <li class="{{ set_active_has('batch','2014-2018') }}"><a href="{{ route('alumini.index') }}?batch=2014-2018">2014 - 2018</a></li>
                        <li class="{{ set_active_has('batch','2015-2019') }}"><a href="{{ route('alumini.index') }}?batch=2015-2019">2015 - 2019</a></li>
                        <li class="{{ set_active_has('batch','2016-2020') }}"><a href="{{ route('alumini.index') }}?batch=2016-2020">2016 - 2020</a></li>
                    </ul>
                </div><p></p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('alumini.create', 'Add New Alumini', [], ['class' => 'btn btn-primary btn-sm']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Alumini Speak</h3></div>--}}

                <div class="grid container">
                @forelse($aluminis as $alumini)

                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <img class="img" data-src="holder.js/100%x200" alt="100%x200" src="images/{{ $alumini->getPhoto() }}" data-holder-rendered="true" style="width: 100%">

                                {{-- Delete Form --}}
                                @if(Auth::check() && Auth::user()->isSuperAdmin())
                                    <div class="pull-left">
                                        {{ Form::open(['method' => 'delete', 'route' => ['alumini.destroy',$alumini->id]]) }}
                                        <button data-toggle="tooltip" title="Delete" class="btn btn-link btn-xs confirm"><i class="fa fa-trash"></i></button>
                                        {{ Form::close() }}
                                    </div>
                                @endif

                                <div class="caption text-center alumini-body">
                                    <h4>{{ $alumini->speaker }}</h4>
                                    <p class="text-center">
                                        {{ ($alumini->batch) }}<br>
                                        {{ $alumini->department->name or "" }}
                                    </p>
                                    <p>
                                        <i>{{ $alumini->profession }} {{ $alumini->organisation_id != null ? "at ".$alumini->organisation->name : "" }}</i>
                                    </p>

                                    @if($alumini->speech != null && !empty($alumini))
                                    <p class="well well-sm" data-toggle="tooltip" title="{{ $alumini->speech }}">
                                        <i><span class='text-lg'>&#8220;</span> {{ str_limit($alumini->speech)  }} <span class='text-lg'>&#8221;</span>
                                        </i>
                                    </p>
                                    @endif

                                    @can('edit',$alumini)
                                        <a data-toggle="tooltip" title="Edit Alumini" class="pull-left btn-xs btn btn-info" href="{{ route('alumini.edit',$alumini->id) }}"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    <p class="blockquote-reverse">
                                        <b>Email:</b> {{ $alumini->email }}<br>
                                    </p>
                                </div>
                            </div>
                        </div>

                @empty
                    <div class="col-sm-8 text-center grid-item col-md-8" style="width:90% !important;">
                        <div class="thumbnail">
                            <h1>List is Empty</h1>
                            <h3>No Alumini of batch {{ Request::get('batch') }}</h3>
                        </div>
                    </div>
                @endforelse
                    </div>
                </div>
                <div class="text-center">
                    {{ $aluminis->render() }}
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    <script>
        /**
         * Masonry
         */
        $(window).load(function(){
            $('.grid').masonry({
                itemSelector: ".grid-item",
                "columnWidth": 330
            });
        });
    </script>
@endsection