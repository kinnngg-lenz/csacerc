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
                <div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Code War</h3></div>
                @forelse($questions as $question)
                    <div class="panel col-md-11">
                        <h4>{{ link_to_route('codewar.show', $question->title, [$question->slug]) }}</h4>
                        @unless(is_null($question->description) || empty($question->description))
                        <div class="panel well padding10">{!! (render_markdown_for_view($question->description)) !!}</div>
                        @endunless
                        <p class="blockquote-reverse">
                            <span class="text-small">{{  $question->created_at->diffForHumans() }}<br></span>
                        </p>
                    </div>
                @empty
                    Empty
                @endforelse
            </div>
            <div class="text-center">
                {{ $questions->render() }}
            </div>
        </div>
    </div>
    </div>
@endsection
