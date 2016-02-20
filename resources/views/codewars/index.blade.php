@extends('layouts.app')
@section('title', "Code Wars")
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
                <h1>Code War</h1>
                <p class="">Participate in the challeges and show your skills</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('codewar.create', 'Start New War', [], ['class' => 'btn btn-info']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">
                @forelse($questions as $question)
                    <div class="panel col-md-11">
                        <h4>{{ link_to_route('codewar.show', $question->title, [$question->slug]) }}</h4>
                        {{--@unless(is_null($question->description) || empty($question->description))
                        <div class="panel well padding10">{!! (render_markdown_for_view($question->description)) !!}</div>
                        @endunless--}}

                                <span class="text-muted">Total Answers: </span>
                                    <i>
                                    <span class="badge">
                                        {{  $question->answers->count() }}
                                    </span>
                                    </i>


                        @unless(is_null($question->bestAnswer()->first()) || $question->ends_at > \Carbon\Carbon::now())
                            |
                        <span class="text-muted">Winner: </span>
                            <i>
                                    <span class="">
                                        {{  link_to_route('users.profile.show',$question->bestAnswer()->first()->user()->first()->name,$question->bestAnswer()->first()->user()->first()->username) }}
                                    </span>
                            </i>

                        @endunless


                        <p class="blockquote-reverse">
                            <i><span class="text-small">Started {{  $question->created_at->diffForHumans() }}</span></i>
                        </p>
                        @if($question->ends_at == null)
                            <p class="blockquote-reverse">No End Time</p>
                        @elseif($question->ends_at < Carbon\Carbon::now())
                            <p class="blockquote-reverse text-danger">Ended {{ $question->ends_at->diffForHumans() }}</p>
                        @else
                            <p class="blockquote-reverse">
                                <span class="">Ends approx {{ $question->ends_at->diffForHumans() }}</span>
                            </p>
                        @endif
                    </div>
                @empty
                    <p>Empty</p>
                @endforelse
            </div>
            <div class="text-center">
                {{ $questions->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection
