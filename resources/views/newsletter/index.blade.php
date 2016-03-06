@extends('layouts.app')
@section('title', 'Newsletter')
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
                <h1>Newsletter</h1>
                <p class="">Download or view Newsletter sorted latest.</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{-- link_to_route('notes.create', 'Upload Notes', [], ['class' => 'btn btn-info btn-sm']) --}}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">

                <div class="grid container">

                    <div class="col-sm-6 grid-item col-md-4">
                            <div class="thumbnail">
                                <div class="padding10 header">
                                    <h2 class="">Voyage v3</h2>
                                </div>
                                <div class="caption">
                                    <p class="blockquote-reverse">
                                        <b>By:</b> Xyz<br>
                                        <i class="text-small">
                                            Uploaded 2 days ago</i>
                                    </p>
                                    {{ link_to_route('newsletter.show',"Read Online",["voyage_3"],['class' => 'btn btn-info btn-block btn-sm']) }}
                                    {{ link_to_route('newsletter.download',"Download",["voyage_3"],['class' => 'btn btn-primary btn-block btn-sm']) }}
                                </div>
                            </div>
                        </div>


                    <div class="col-sm-6 grid-item col-md-4">
                        <div class="thumbnail">
                            <div class="padding10 header">
                                <h2 class="">Voyage v2</h2>
                            </div>
                            <div class="caption">
                                <p class="blockquote-reverse">
                                    <b>By:</b> Abc<br>
                                    <i class="text-small">
                                        Uploaded 21 days ago</i>
                                </p>
                                {{ link_to_route('newsletter.show',"Read Online",["voyage_3"],['class' => 'btn btn-info btn-block btn-sm']) }}
                                {{ link_to_route('newsletter.download',"Download",["voyage_3"],['class' => 'btn btn-primary btn-block btn-sm']) }}
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 grid-item col-md-4">
                        <div class="thumbnail">
                            <div class="padding10 header">
                                <h2 class="">Voyage v1</h2>
                            </div>
                            <div class="caption">
                                <p class="blockquote-reverse">
                                    <b>By:</b> Mno<br>
                                    <i class="text-small">
                                        Uploaded 2 months ago</i>
                                </p>
                                {{ link_to_route('newsletter.show',"Read Online",["voyage_3"],['class' => 'btn btn-info btn-block btn-sm']) }}
                                {{ link_to_route('newsletter.download',"Download",["voyage_3"],['class' => 'btn btn-primary btn-block btn-sm']) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="text-center">

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
