@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('gallery.create', 'Add new Image', [], ['class' => 'btn btn-danger btn-sm']) }}
                @endif
            </div>
            <div class="col-md-11 col-md-offset-1">

                <div id='gallery'>
                    @forelse($images as $image)
                        <a href="/images/{{ $image->url }}">
                            <img src="/images/{{ $image->url }}"
                                 title="photo{{ $image->id }} title">
                        </a>
                    @empty
                        Empty
                    @endforelse
                </div>
                </div>
            <div class="text-center">
                {{ $images->render() }}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        // applying photobox on a `gallery` element which has lots of thumbnails links.
        // Passing options object as well:
        //-----------------------------------------------
        $('#gallery').photobox('a',{ time:0 });

        // using a callback and a fancier selector
        //----------------------------------------------
        $('#gallery').photobox('li > a.family',{ time:0 }, callback);
        function callback(){
            console.log('image has been loaded');
        }

        // destroy the plugin on a certain gallery:
        //-----------------------------------------------
        $('#gallery').photobox('destroy');

        // re-initialize the photbox DOM (does what Document ready does)
        //-----------------------------------------------
        $('#gallery').photobox('prepareDOM');
    </script>
@endsection