@extends('layouts.app')
@section('title', 'Notes &amp Papers')
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
        .thumbnail .header
        {
            background: url('/images/static/head.png') #573e81;
            color: white;
            background-size: contain;
            text-align: center;
        }
        .thumbnail .header h2
        {
            font-weight:100 !important;
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
                <h1>Notes & Papers</h1>
                <p class="">Download notes and papers provided by faculties and listed semester wise.</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('notes.create', 'Add Notes', [], ['class' => 'btn btn-info btn-sm']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">

                <div class="grid container">
                    @forelse($notes as $note)

                        <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <div class="padding10 header">
                                    <h2 class="nomargin">{{ $note->name }}</h2>
                                </div>
                                <div class="caption">
                                    <p>
                                        <strong>Dept: </strong>{{ $note->department->name }}
                                    </p>
                                    <p>
                                        <strong>Semester: </strong>{{ $note->semester }}
                                    </p>
                                    <p class="blockquote-reverse">
                                        <b>By:</b> {{ $note->owner }}<br>
                                        <i class="text-small">
                                            Uploaded {{ $note->created_at->diffForHumans() }}</i>
                                    </p>
                                    {{ link_to_route('notes.download',"Download",[$note->id],['class' => 'btn btn-info btn-block btn-sm']) }}
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="container">
                            <h1>No Notes Available</h1>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="text-center">
                {{ $notes->render() }}
            </div>
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
