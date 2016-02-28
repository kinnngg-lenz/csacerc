@extends('layouts.app')
@section('title', 'Image Gallery')

@unless(Agent::isMobile())
@section('styles')
    <link rel="stylesheet" href="/css/facebox.css">
@endsection
@endunless

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                @if(Auth::check() && Auth::user()->isAdmin())
                    {{ link_to_route('gallery.create', 'Add new Image', [], ['class' => 'btn btn-info btn-sm']) }}
                @endif
            </div>
            <div class="col-md-10 col-md-offset-1">

                <div id="container"></div>
                <div id="images">
                    @forelse($images as $image)
                        <div class="item">
                            <a href="/images/{{ $image->url }}" rel="facebox">
                                <img src="/images/{{ $image->url }}">
                            </a>
                        </div>
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
    </div>
@endsection


@section('scripts')
    @unless(Agent::isMobile())
        <script type="text/javascript" src="/js/facebox.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('a[rel*=facebox]').facebox({
                    loadingImage: '../images/static/ajax-loading.gif',
                    closeImage: '../images/static/closelabel.png'
                })
            })
        </script>
    @endunless

    <script type="text/javascript">
        $(function () {

            var $container = $('#container').masonry({
                itemSelector: '.item',
                columnWidth: 300
            });

            // reveal initial images
            $container.masonryImagesReveal($('#images').find('.item'));
        });

        $.fn.masonryImagesReveal = function ($items) {
            var msnry = this.data('masonry');
            var itemSelector = msnry.options.itemSelector;
            // hide by default
            $items.hide();
            // append to container
            this.append($items);
            $items.imagesLoaded().progress(function (imgLoad, image) {
                // get item
                // image is imagesLoaded class, not <img>, <img> is image.img
                var $item = $(image.img).parents(itemSelector);
                // un-hide item
                $item.show();
                // masonry does its thing
                msnry.appended($item);
            });

            return this;
        };
    </script>
@endsection