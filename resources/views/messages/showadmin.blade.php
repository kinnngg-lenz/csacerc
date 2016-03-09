@extends('layouts.app')
@section('title', "Conversation btw {$recuser1->name} & {$recuser2->name}")
@section('styles')
    <style>
        .red{
            color:red;
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
        .chatbox1:after
        {
            content: "";
            position: absolute;
            right: 66px;
            top: 11px;
            border-width: 10px 0px 10px 15px;
            border-style: solid;
            border-color: transparent #FFFFFF;
            display: block;
            width: 0;
        }
        .chatbox2:before
        {
            content: "";
            position: absolute;
            left: 66px;
            top: 11px;
            border-width: 10px 15px 10px 0px;
            border-style: solid;
            border-color: transparent #FFFFFF;
            display: block;
            width: 0;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h3>Conversation btw {{ link_to_route('users.profile.show',$recuser1->name,$recuser1->username,['class' => 'text-info']) }} &amp; {{ link_to_route('users.profile.show',$recuser2->name,$recuser2->username,['class' => 'text-info']) }}</h3>
            </div>

            <div class="container" style="margin-bottom:30px;margin-top:20px;">
                @forelse($messages as $message)
                    @if($message->sender_id > $message->receiver_id)
                        <div class="media col-md-8 col-md-offset-2">
                            <div class="media-left">
                                <a href="{{ route('users.profile.show',$message->sender->username) }}"><img src="/images/{{ $message->sender->getProfilePicUrl() }}" alt="" class="img img-circle" width="50"></a>
                            </div>
                            <div class="media-body panel padding10 chatbox2">

                                {{-- Delete Form --}}
                                @can('delete',$message)
                                <div class="pull-right">
                                    {{ Form::open(['method' => 'delete', 'route' => ['messages.delete',$message->id]]) }}
                                    <button data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-link btn-xs"><i class="fa fa-trash"></i></button>
                                    {{ Form::close() }}
                                </div>
                                @endcan

                                <p class=""><b>{{ link_to_route('users.profile.show',$message->sender->name,$message->sender->username) }}</b> <span><i class="tiny text-muted">{{ $message->created_at->diffForHumans() }}</i></span></p>
                                @if($message->seen_at == null)
                                    <p><span class="label label-info">New</span></p>
                                @endif
                                <p>{!! nl2br(htmlentities($message->message)) !!}</p>
                            </div>
                        </div>
                    @else
                        <div class="media col-md-8 col-md-offset-2">
                            <div class="media-body panel padding10 chatbox1 text-right">

                                {{-- Delete Form --}}
                                @can('delete',$message)
                                <div class="pull-left">
                                    {{ Form::open(['method' => 'delete', 'route' => ['messages.delete',$message->id]]) }}
                                    <button data-toggle="tooltip" data-placement="right" title="Delete" class="btn btn-link btn-xs"><i class="fa fa-trash"></i></button>
                                    {{ Form::close() }}
                                </div>
                                @endcan

                                <p class=""><b>{{ link_to_route('users.profile.show',$message->sender->name,$message->sender->username) }}</b> <span><i class="tiny text-muted">{{ $message->created_at->diffForHumans() }}</i></span></p>
                                @if($message->seen_at == null)
                                    <p><span class="label label-info">New</span></p>
                                @endif
                                <p>{!! nl2br(htmlentities($message->message)) !!}</p>
                            </div>
                            <div class="media-right">
                                <a href="{{ route('users.profile.show',$message->sender->username) }}"><img src="/images/{{ $message->sender->getProfilePicUrl() }}" alt="" class="img img-circle" width="50"></a>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="well col-md-8 col-md-offset-2">
                        <h4 class="text-danger text-center"><i>No Conversation between these two.</i></h4>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="text-center">
            {{ $messages->render() }}
        </div>
    </div>

@endsection