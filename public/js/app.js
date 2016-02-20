/**
 * Created by Zishan on 08-Feb-16.
 */
$(document).ready(function(){
   $('.notification').delay(2000).slideUp(1000);
    $("[data-toggle='tooltip']").tooltip();

   hljs.initHighlightingOnLoad();

    var users = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: "/users/%QUERY",
            wildcard: '%QUERY'
        }
    });

    users.initialize();

    $('.navsearch').typeahead({
            hint: true,
            highlight: true,
            minlength: 3
        },
        {
            name: 'users',
            limit: 5,
            displayKey: 'username',
            source: users.ttAdapter(),
            templates: {
                suggestion: function(data){
                    return '<p><a href="/@' +data.username+ '">' + data.username + '</a> - ' + data.name + '</p>';
                }
            }
        }
    );
    // TypeAhead Ends

    // Spin fa Icon on Hover
    $('.spin').hover(function(){
            $(this).children().children().addClass('fa-spin')
    },
        function () {
            $(this).children().children().removeClass('fa-spin')
        });


    // Testimonial Function
    $('.cd-testimonials-wrapper').flexslider({
        selector: ".cd-testimonials > li",
        animation: "slide",
        controlNav: false,
        slideshow: false,
        smoothHeight: true,
        start: function(){
            $('.cd-testimonials').children('li').css({
                'opacity': 1,
                'position': 'relative'
            });
        }
    });

    //open the testimonials modal page
    $('.cd-see-all').on('click', function(){
        $('.cd-testimonials-all').addClass('is-visible');
    });

    //close the testimonials modal page
    $('.cd-testimonials-all .close-btn').on('click', function(){
        $('.cd-testimonials-all').removeClass('is-visible');
    });
    $(document).keyup(function(event){
        //check if user has pressed 'Esc'
        if(event.which=='27'){
            $('.cd-testimonials-all').removeClass('is-visible');
        }
    });

    //build the grid for the testimonials modal page
    $('.cd-testimonials-all-wrapper').children('ul').masonry({
        itemSelector: '.cd-testimonials-item'
    });

});

// Carousel Function
$(function() {
    $('#slider').carouFredSel({
        width: '100%',
        align: false,
        items: 3,
        items: {
            width: $('#wrapper').width() * 0.15,
            height: 500,
            visible: 1,
            minimum: 1
        },
        scroll: {
            items: 1,
            timeoutDuration : 5000,
            onBefore: function(data) {

                //	find current and next slide
                var currentSlide = $('.slide.active', this),
                    nextSlide = data.items.visible,
                    _width = $('#wrapper').width();

                //	resize currentslide to small version
                currentSlide.stop().animate({
                    width: _width * 0.15
                });
                currentSlide.removeClass( 'active' );

                //	hide current block
                data.items.old.add( data.items.visible ).find( '.slide-block' ).stop().fadeOut();

                //	animate clicked slide to large size
                nextSlide.addClass( 'active' );
                nextSlide.stop().animate({
                    width: _width * 0.7
                });
            },
            onAfter: function(data) {
                //	show active slide block
                data.items.visible.last().find( '.slide-block' ).stop().fadeIn();
            }
        },
        onCreate: function(data){

            //	clone images for better sliding and insert them dynamacly in slider
            var newitems = $('.slide',this).clone( true ),
                _width = $('#wrapper').width();

            $(this).trigger( 'insertItem', [newitems, newitems.length, false] );

            //	show images
            $('.slide', this).fadeIn();
            $('.slide:first-child', this).addClass( 'active' );
            $('.slide', this).width( _width * 0.15 );

            //	enlarge first slide
            $('.slide:first-child', this).animate({
                width: _width * 0.7
            });

            //	show first title block and hide the rest
            $(this).find( '.slide-block' ).hide();
            $(this).find( '.slide.active .slide-block' ).stop().fadeIn();
        }
    });

    //	Handle click events
    $('#slider').children().click(function() {
        $('#slider').trigger( 'slideTo', [this] );
    });

    //	Enable code below if you want to support browser resizing
    $(window).resize(function(){

        var slider = $('#slider'),
            _width = $('#wrapper').width();

        //	show images
        slider.find( '.slide' ).width( _width * 0.15 );

        //	enlarge first slide
        slider.find( '.slide.active' ).width( _width * 0.7 );

        //	update item width config
        slider.trigger( 'configuration', ['items.width', _width * 0.15] );
    });

});