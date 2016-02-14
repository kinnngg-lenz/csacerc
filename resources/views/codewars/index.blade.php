@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('codewar.create', 'Create new CodeWar', [], ['class' => 'btn btn-danger btn-sm']) }}
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
