@extends('layouts.app')
@section('title', "Firewall System")
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
                <h1>Firewall System</h1>
                <p>(Restricted Area)</p>
                <!-- Single button -->

                <div class="col-md-5 col-md-offset-4">
                    {{ Form::open(['route' => 'firewall.store']) }}
                    <div class="input-group {{ $errors->has('ip_address') ? ' has-error' : '' }}">
                        <input class="form-control" placeholder="IP Address" name="ip_address" type="text">
                                <span class="add-on input-group-btn">
                                        <button class="confirm btn btn-info" type="submit">
                                            Ban this IP
                                        </button>
                                    </span>
                    </div>
                    @if ($errors->has('ip_address'))
                        <span class="help-block text-danger">
                        <strong>{{ $errors->first('ip_address') }}</strong>
                        </span>
                    @endif
                    {{ Form::close() }}

                </div>

               </div>
            </div>

            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Alumini Speak</h3></div>--}}

                <div class="container">
                    <div class="col-md-10">
                        @if(!$ips->isEmpty())
                    <table class="panel table table-hover table-striped">
                        <thead> <tr> <th>#</th> <th>Ip Address</th> <th>Banned time</th><th class="text-center">Remove Ban</th>  </tr> </thead>
                        <tbody>
                        @foreach($ips as $ip)
                        <tr> <th scope="row">{{ $ip->id }}</th> <td>{{ $ip->ip_address }}</td> <td>{{ $ip->created_at->diffForHumans() }}</td>
                        <td class="text-center">
                            {{ Form::open(['method' => 'delete', 'route' => ['firewall.destroy',$ip->ip_address]]) }}
                            {{ Form::submit("Remove Ban",['class' => 'btn btn-xs btn-danger confirm']) }}
                            {{ Form::close() }}
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>

                    @else
                    <div class="col-sm-12 text-center col-md-12">
                            <div class="thumbnail">
                                <h1>List is Empty</h1>
                            </div>
                        </div>
                        @endif

                </div>
            </div>
            <div class="text-center">
                {{ $ips->render() }}
            </div>
        </div>
    </div>
@endsection