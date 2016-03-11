@extends('layouts.app')
@section('title', 'Dashboard')
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
            font-size: 14px !important;
        }

        .inspire {
            font-size: 2rem !important;;
        }

        .text-lg {
            font-size: 1.5em !important;
            font-family: "Trebuchet MS", Verdana, sans-serif;
        }

        .stats {
            font-size: 18px !important;
        }

        .start-con-form .twitter-typeahead {
            width: 100% !important;
            margin-top: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>Dashboard</h1>
                <p id="ajaxinspire">
                    <span class="inspire text-{{ ['warning','success','info', 'danger', 'yellow', 'pink', 'green', 'violet', 'muted'][array_rand([0,1,2,3,4,5,6,7,8])] }}"><span
                                class="text-lg">&#8220;</span> {{ \App\Quote::quote() }} <span
                                class="text-lg">&#8221;</span></span>
                </p>
                <p class="">Welcome abroad <span style="color: #91B5FF;">{{ Auth::user()->name }}</span></p>
                <p class="tiny text-muted">Your rank is <b>{{ Auth::user()->rank() }}</b></p>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><b> <i class="fa fa-bar-chart"></i> Your Statistics</b></div>
                    <div class="panel-body text-center stats">
                        <p>You have <kbd class="text-lg">{{ Auth::user()->xp }}</kbd> e<b>X</b>perience points <i class="fa fa-trophy"></i></p>
                        <p>You have attempted <kbd class="text-lg">{{ Auth::user()->codeWarAnswers->count() }}</kbd> {{ str_plural("codewar", Auth::user()->codeWarAnswers->count() ) }} <i class="fa fa-code"></i></p>
                        <p>You have asked <kbd class="text-lg">{{ Auth::user()->questions->count() }}</kbd>  {{ str_plural("question", Auth::user()->questions->count() ) }} <i class="fa fa-question"></i></p>
                        <p>You have sent <kbd class="text-lg">{{ Auth::user()->messages->count() }}</kbd> {{ str_plural("message", Auth::user()->messages->count() ) }} <i class="fa fa-mail-forward"></i></p>
                        <p>You have received <kbd class="text-lg">{{ Auth::user()->receivedMessages()->count() }}</kbd> {{ str_plural("message", Auth::user()->receivedMessages()->count() ) }} <i class="fa fa-mail-reply"></i></p>

                        {{-- <a href="{{ route('questions.user.unanswered') }}">You have {{ Auth::user()->notAnsweredQuestions()->approved()->count().str_plural(' question', Auth::user()->notAnsweredQuestions()->count()) }} to answer.</a>--}}
                        <br>
                    </div>
                </div>
            </div>

            @if(Auth::user()->isAdmin())
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b> <i class="fa fa-user"></i> Admin Panel</b>
                            (<i>{{ Auth::user()->rank() }}</i>)
                        </div>
                        <div class="panel-body">
                            {{ link_to_route('news.create', 'Add a News', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                            {{ link_to_route('alumini.create', 'Add an Alumini', [], ['class' => 'btn btn-danger btn-block btn-sm']) }}
                            {{ link_to_route('event.create', 'Add an Event', [], ['class' => 'btn btn-success btn-block btn-sm']) }}
                            {{ link_to_route('questions.pending', 'Pending Questions', [], ['class' => 'btn btn-primary btn-block btn-sm']) }}
                            {{ link_to_route('codewar.create', 'Create a CodeWar', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                            {{ link_to_route('gallery.create', 'Add Image to Gallery', [], ['class' => 'btn btn-warning btn-block btn-sm']) }}
                            {{ link_to_route('quotes.create', 'Add Quote', [], ['class' => 'btn btn-success btn-block btn-sm']) }}
                            {{ link_to_route('org.create', 'Add Company/Org', [], ['class' => 'btn btn-info btn-block btn-sm']) }}
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><b> <i class="fa fa-question-circle"></i> Questions</b></div>
                        <div class="panel-body">
                            <a data-toggle="tooltip" data-placement="left"
                               title="Question that are asked to you by someone" class="btn btn-sm btn-block btn-info"
                               href="{{ route('questions.user.unanswered') }}">To be answered <span
                                        class="badge">{{Auth::user()->notAnsweredQuestions()->approved()->count()}}</span></a>
                            <a data-toggle="tooltip" data-placement="left" title="Question that you asked to someone"
                               class="btn btn-sm btn-block btn-info" href="{{ route('questions.iasked') }}">I Asked</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Questions</b></div>
                        <div class="panel-body">
                            <a data-toggle="tooltip" data-placement="left"
                               title="Question that are asked to you by someone" class="btn btn-sm btn-block btn-info"
                               href="{{ route('questions.user.unanswered') }}">To be answered <span
                                        class="badge">{{Auth::user()->notAnsweredQuestions()->approved()->count()}}</span></a>
                            <a data-toggle="tooltip" data-placement="left" title="Question that you asked to someone"
                               class="btn btn-sm btn-block btn-info" href="{{ route('questions.iasked') }}">I Asked</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><b> <i class="fa fa-envelope"></i> Conversations</b></div>
                <div class="panel-body text-center stats">
                    <p>You have <kbd class="">{{ Auth::user()->receivedMessagesUnseen()->count() }}</kbd> new {{ str_plural('message', Auth::user()->receivedMessagesUnseen()->count()) }} <i class="fa fa-envelope-o"></i></p>
                    {{-- <a href="{{ route('questions.user.unanswered') }}">You have {{ Auth::user()->notAnsweredQuestions()->approved()->count().str_plural(' question', Auth::user()->notAnsweredQuestions()->count()) }} to answer.</a>--}}
                    <br>

                    @forelse($messages as $message)
                        <a href="{{ route('messages.show',$message->sender->username) }}">
                            <div class="col-md-4" style="">
                                <p class="padding10" style="border: 1px solid #bababa">
                                    <kbd>{{ $message->receiver->messagesUnseenBy($message->sender->username)->count() }}</kbd>
                                    new {{ str_plural("message",$message->receiver->messagesUnseenBy($message->sender->username)->count()) }}
                                    from {{ $message->sender->name }}</p>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>

                <div class="panel panel-default" style="margin:20px">
                    <div class="panel-heading"><b> <i class="fa fa-mail-forward"></i> Start New Conversation</b></div>
                    <div class="panel-body">
                        <form method="get" action="/conversation/new" class="start-con-form">
                            <div class="input-group col-md-7 col-md-offset-2">
                                {{ Form::text('with',null,['class' => 'formsearch subscriber_email_input form-control', 'placeholder' => 'Username or Email']) }}
                                <span class="add-on input-group-btn">
                                        <button class="btn btn-info" type="submit">
                                            Start
                                        </button>
                                    </span>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

            <div class="col-md-4">
                @include('partials.shoutbox',['shouts' => $shouts])
            </div>
        </div>

        {{--Alumini Profile Row--}}
        <div class="row">
            <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Edit your Alumini Profile</b></div>
                <div class="panel-body">

                    @forelse($aluminis as $alumini)
                        <a href="{{ route('alumini.edit',$alumini->id) }}">
                            <div data-toggle="tooltip" title="Edit {{ $alumini->speaker }}" class="col-md-5 col-xs-5 no-padding" style="border: 1px solid #bababa;margin: 10px">
                                <div class="col-md-4 no-padding">
                                    <img style="height: 80px;width: 100%;" class="img" src="/image/{{ $alumini->getPhoto() }}/thumbnail/100" alt="">
                                </div>
                                <div class="col-md-8 col-xs-8 no-padding">
                                <p class="padding10">
                                    {{ $alumini->speaker }}
                                    </p>
                                </div>
                            </div>
                        </a>
                     @empty
                        <div class="text-center text-danger">
                            <p>No Alumini profile has been associated with your account.
                                <br>If you are an alumini and wishes to add one then please contact Admin or shout!.
                            </p>
                        </div>
                    @endforelse

                </div>
            </div>
            </div>

            @if(Auth::user()->isSuperAdmin())
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Website Statistics</b></div>
                    <div class="panel-body">
                        <h4>We have currently:</h4>
                        <p><kbd>{{ \App\User::count() }}</kbd> registered members.</p>
                        <p><kbd>{{ \App\User::whereType(0)->count() }}</kbd> students.</p>
                        <p><kbd>{{ \App\User::whereType(1)->count() }}</kbd> faculty members.</p>
                        <p><kbd>{{ \App\User::where('role','>',0)->count() }}</kbd> admins.</p>
                        <p><kbd>{{ \App\Alumini::count() }}</kbd> aluminis.</p>
                        <p><kbd>{{ \App\CodeWarQuestion::count() }}</kbd> codewars.</p>
                        <p><kbd>{{ \App\News::count() }}</kbd> news.</p>
                        <p><kbd>{{ \App\Event::count() }}</kbd> events.</p>
                        <p><kbd>{{ \App\Quote::count() }}</kbd> quotes.</p>
                        <p><kbd>{{ \App\Organisation::count() }}</kbd> companies.</p>
                        <p><kbd>{{ \App\Photo::whereGallery(1)->count() }}</kbd> images in gallery.</p>
                        <p><kbd>{{ \App\Message::count() }}</kbd> private messages sent.</p>
                    </div>
                </div>
            </div>
            @endif

        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        // Quotes AJAX load
        function update_div() {
            $('#ajaxinspire').fadeOut('normal', function () {
                $('#ajaxinspire').load('/inspire');
                $('#ajaxinspire').fadeIn(3000, function () {
                    window.setTimeout("update_div()", 8000);
                });
            });
        }
        update_div();

        $(document).ready(function(){
            /**
             * For Scroll To Bottom
             */
            $(".messageLog").animate({ scrollTop: $(".messageLog")[0].scrollHeight}, 1000);

        });

    </script>
@endsection