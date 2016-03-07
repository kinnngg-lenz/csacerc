@extends('layouts.app')
@section('title', 'Conversation with '.$recuser->name)
@section('styles')
    <style>
        .red {
            color: red;
        }

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
    </style>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h3>Your Conversation
                    with {{ link_to_route('users.profile.show',$recuser->name,$recuser->username,['class' => 'text-info']) }}</h3>
            </div>
            <div class="container">
                <br style="clear:both">
                {{ Form::open() }}
                <div class="col-md-8 col-md-offset-2 form-group{{ $errors->has('message') ? ' has-error' : '' }}">

                    {{ Form::textarea('message',null,['id' => 'message', 'class' => 'form-control no-resize', 'rows' => '2', 'placeholder' => 'Your message here']) }}
                    <span class="help-block pull-right"><p id="characterLeft" class="nomargin help-block ">You have
                            reached the limit</p></span>
                    @if ($errors->has('message'))
                        <span class="help-block">
                <strong>{{ $errors->first('message') }}</strong>
                </span>
                    @endif
                    {{ Form::submit('Send Message',['class' => 'form-control btn btn-info disabled', 'id' => 'btnSubmit']) }}
                </div>
                <div class="form-group col-md-3 col-md-offset-2">
                </div>
                {{ Form::close() }}
            </div>

            <div class="container" style="margin-bottom:30px;margin-top:20px;">
                @forelse($messages as $message)
                    @if($message->sender_id > $message->receiver_id)
                        <div class="media col-md-8 col-md-offset-2">
                            <div class="media-left">
                                <a data-toggle="tooltip" data-placement="right" title="{{ $message->sender->name }}" href="{{ route('users.profile.show',$message->sender->username) }}"><img
                                            src="/images/{{ $message->sender->getProfilePicUrl() }}" alt=""
                                            class="img img-circle" width="50"></a>
                            </div>
                            <div class="media-body panel padding10">

                                {{-- Delete Form --}}
                                @can('delete',$message)
                                <div class="pull-right">
                                    {{ Form::open(['method' => 'delete', 'route' => ['messages.delete',$message->id]]) }}
                                    <button data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-link btn-xs"><i class="fa fa-trash"></i></button>
                                    {{ Form::close() }}
                                </div>
                                @endcan

                                <p class="">
                                    <b>{{ link_to_route('users.profile.show',$message->sender->name,$message->sender->username) }}</b>
                                    <span><i class="tiny text-muted">{{ $message->created_at->diffForHumans() }}</i></span>
                                </p>
                                @if($message->seen_at == null && $message->receiver_id == Auth::user()->id)
                                    <p><span class="label label-info">New</span></p>
                                    {{ $message->hasBeenSeen() }}
                                @endif
                                <p>{!! nl2br(htmlentities($message->message)) !!}</p>
                            </div>
                        </div>
                    @else
                        <div class="media col-md-8 col-md-offset-2">
                            <div class="media-body panel padding10 text-right">

                                {{-- Delete Form --}}
                                @can('delete',$message)
                                <div class="pull-left">
                                    {{ Form::open(['method' => 'delete', 'route' => ['messages.delete',$message->id]]) }}
                                    <button data-toggle="tooltip" data-placement="right" title="Delete" class="btn btn-link btn-xs"><i class="fa fa-trash"></i></button>
                                    {{ Form::close() }}
                                </div>
                                @endcan

                                <p class="">
                                    <b>{{ link_to_route('users.profile.show',$message->sender->name,$message->sender->username) }}</b>
                                    <span><i class="tiny text-muted">{{ $message->created_at->diffForHumans() }}</i></span>
                                </p>
                                @if($message->seen_at == null && $message->receiver_id == Auth::user()->id)
                                    <p><span class="label label-info">New</span></p>
                                    {{ $message->hasBeenSeen() }}
                                @endif
                                <p>{!! nl2br(htmlentities($message->message)) !!}</p>
                            </div>
                            <div class="media-right">
                                <a data-toggle="tooltip" data-placement="left" title="{{ $message->sender->name }}" href="{{ route('users.profile.show',$message->sender->username) }}"><img
                                            src="/images/{{ $message->sender->getProfilePicUrl() }}" alt=""
                                            class="img img-circle" width="50"></a>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="well col-md-8 col-md-offset-2">
                        <h4 class="text-danger text-center"><i>Its lonely here! Send a message now to start
                                conversation with {{ $recuser->name }}</i></h4>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="text-center">
            {{ $messages->render() }}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#characterLeft').text('1500 characters left');
            $('#message').keyup(function () {
                var max = 1500;
                var len = $(this).val().length;
                console.log(max - len);
                if (len >= max) {
                    var ch = max - len;
                    $('#characterLeft').text(ch + ' characters left');
                    $('#characterLeft').addClass('red');
                    $('#btnSubmit').addClass('disabled');
                }
                else {
                    var ch = max - len;
                    $('#characterLeft').text(ch + ' characters left');
                    $('#btnSubmit').removeClass('disabled');
                    $('#characterLeft').removeClass('red');
                }
            });
        });
    </script>
@endsection