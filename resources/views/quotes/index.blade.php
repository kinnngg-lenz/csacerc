@extends('layouts.app')
@section('title', "Inspiring Quotes")
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
            font-size: 14px;
        }

        .example-wrong:after {
            bottom: -50px;
            border-width: 0 20px 50px 0;
        }

        .example-right:after {
            bottom: -50px;
            border-width: 0 20px 50px 0;
        }

        .text-lg {
            font-size: 1.5em !important;
            font-family: "Trebuchet MS", Verdana, sans-serif;
        }
        .font16
        {
            font-size:16px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center">
                <h1>Inspiring Quotes</h1>
                <p id="ajaxinspire">
                    <span class="inspire text-{{ ['warning','success','info', 'danger', 'yellow', 'pink', 'green', 'violet', 'muted'][array_rand([0,1,2,3,4,5,6,7,8])] }}"><span
                                class="text-lg">&#8220;</span> {{ \App\Quote::quote() }} <span
                                class="text-lg">&#8221;</span></span>
                </p>
                <hr style="border-top-color: #52407D;">
                <p class="nomargin text-muted">Quote of the Day</p>
                <p class="font16">
                        <span class="inspire text-{{ ['warning','success','info', 'danger', 'yellow', 'pink', 'green', 'violet', 'muted'][array_rand([0,1,2,3,4,5,6,7,8])] }}">{!! App\Quote::getQotd() !!}
                    </span></p>

                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('quotes.create', 'Add a Quote', [], ['class' => 'btn btn-info btn-sm']) }}
                @endif
            </div>

            <div class="col-md-11 col-md-offset-1">
                {{--<div class="panel panel-info text-center col-md-7 col-md-offset-2"><h3>quote Speak</h3></div>--}}

                <div class="grid js-masonry container" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 330 }'>
                    @forelse($quotes as $quote)
                        <div class="col-sm-6 grid-item col-md-4">
                            <blockquote class="example-{{ ['obtuse','right','wrong'][array_rand([0,1,2])] }}">
                                <p>
                                    {!! nl2br(htmlentities($quote->text)) !!}
                                </p>
                            </blockquote>
                            <p>
                                @unless(is_null($quote->speaker))
                                    <b> - {{ $quote->speaker }}</b>
                                @else
                                        <i data-toggle="tooltip" title="Said by Anonymous Person" class="fa fa-users"></i>
                                @endunless

                                @can('edit',$quote)
                                <a data-toggle="tooltip" title="Edit Quote" href="{{ route('quotes.edit',$quote->id) }}" class="btn btn-link btn-sm btn-info"><i
                                            class="fa fa-edit"></i></a>
                                @endcan

                                @if(Auth::check() && Auth::user()->isSuperAdmin())
                                            <a data-toggle="tooltip" title="Set as Quote of the Day" href="{{ route('quotes.setasqotd',$quote->id) }}" class="btn btn-link btn-sm btn-info"><i
                                                        class="fa fa-flag text-info"></i></a>
                                @endif
                            </p>
                        </div>
                    @empty
                        Empty
                    @endforelse
                </div>
            </div>
            <div class="text-center">
                {{ $quotes->render() }}
            </div>
        </div>
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
    </script>
@endsection