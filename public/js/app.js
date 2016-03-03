/**
 * Created by Zishan on 08-Feb-16.
 */
$(document).ready(function(){
   $('.notification').delay(7000).fadeOut(1000);
    $("[data-toggle='tooltip']").tooltip();

    // Setup Select2 Instance
    $("select").select2();

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