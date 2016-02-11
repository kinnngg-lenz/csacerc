@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                    {{ link_to_route('questions.create', 'Ask a Question', [], ['class' => 'btn btn-danger btn-sm']) }}
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>Questions & Answers</h3></div>
                @forelse($questions as $question)
                    <div class="panel col-md-11 well">
                        Question:
                        {{-- @TODO: Unsecured. Secure this code, and filter thru Markdown --}}
                        <div class="panel padding10">{!! (render_markdown_for_view($question->question)) !!}</div>
                        Answer:
                        <div class="panel padding10">
                            @if(is_null($question->answer))
                                @can('answer', $question)
                                <i class='text-danger'>No answered yet!</i>
                                <div class="text-right">{{ link_to_route('questions.show', 'Answer this Question', [$question->slug], ['class' => 'btn btn-danger btn-sm float-right']) }}</div>
                                @else
                                <i class='text-danger'>No answered yet!</i>
                                @endcan
                            @else
                                {!! (render_markdown_for_view($question->answer)) !!}
                            @endif
                        </div>

                        <p class="blockquote-reverse">
                        <span class="text-small">{{ link_to_route('questions.show', $question->created_at->diffForHumans(), $question->slug) }}<br></span>
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
