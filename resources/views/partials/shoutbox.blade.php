<div class="shoutbox-cont">
    <div class="panel panel-primary">
        <div class="panel-heading" id="accordion">
            <span class="fa fa-comment"></span> Shoutbox
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion"
                   href="#collapseOne">
                    <span class="fa fa-chevron-down"></span>
                </a>
            </div>
        </div>
        <div class="" id="collapseOne">
            <div class="panel-body messageLog">
                <ul class="chat" id="shoutbox-chat">

                    @foreach($shouts as $shout)

                        @if($shout->user_id % 2 == 0)

                            <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="/image/{{ $shout->user->getProfilePicUrl() }}/thumbnail/60" width="50" height="50" alt="User Avatar" class="img-circle"/>
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <a href="{{ route('users.profile.show',$shout->user->username) }}">
                                            <strong class="primary-font">{{ $shout->user->name }}</strong>
                                        </a>
                                        <small class="pull-right text-muted">
                                            <span class="fa fa-clock-o"></span> {{ $shout->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p>
                                        {!! nl2br(htmlentities($shout->shout)) !!}
                                    </p>
                                </div>
                            </li>
                        @else

                            <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="/image/{{ $shout->user->getProfilePicUrl() }}/thumbnail/60" width="50" height="50" alt="User Avatar" class="img-circle"/>
                        </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted"><span class="fa fa-clock-o"></span> {{ $shout->created_at->diffForHumans() }}
                                        </small>
                                            <a href="{{ route('users.profile.show',$shout->user->username) }}">
                                        <strong class="pull-right primary-font">{{ $shout->user->name }}</strong>
                                            </a>
                                    </div>
                                    <p class="text-right">
                                        {!! nl2br(htmlentities($shout->shout)) !!}
                                    </p>
                                </div>
                            </li>
                        @endif

                    @endforeach

                </ul>
            </div>
            <div class="panel-footer">
                @if(Auth::check())
                {{ Form::open(['route' => 'shouts.store','id' => 'shoutbox-form']) }}
                <div id="shout-input-group" class="input-group">
                    <input name="shout" id="btn-input" type="text" class="form-control input-sm"
                           placeholder="Type your message here..."/>
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" id="btn-chat">
                                Send
                            </button>
                        </span>
                </div>
                    <div id="shout-input-group-error" class="help-block"></div>

                {{ Form::close() }}
                 @else
                    <div class='panel nomargin padding10 text-muted'><b>Please {{ link_to('/login','Login') }}
                            or {{ link_to('/register', 'Register') }} to shout.</b></div>
                @endif
            </div>
        </div>
    </div>
</div>


<style>
    .shoutbox-cont .chat {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .shoutbox-cont .chat li {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .shoutbox-cont .chat li.left .chat-body {
        margin-left: 60px;
    }

    .shoutbox-cont .chat li.right .chat-body {
        margin-right: 60px;
    }

    .shoutbox-cont .chat li .chat-body p {
        margin: 0;
        color: #777777;
    }

    .shoutbox-cont .panel .slidedown .fa, .chat .fa {
        margin-right: 5px;
    }

    .shoutbox-cont .panel-body {
        overflow-y: auto;
        height: 400px;
    }

    .shoutbox-cont ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    .shoutbox-cont ::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    .shoutbox-cont ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #555;
    }
</style>