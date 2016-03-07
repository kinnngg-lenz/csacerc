/**
 * Created by Zishan on 08-Feb-16.
 */
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    autosize($('textarea'));

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
                    return '<p><a href="/@' +data.username+ '">' + data.username + ' - ' + data.name + '</a></p>';
                }
            }
        }
    );
    $('.formsearch').typeahead({
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
                    return '<p>@' + data.username + ' - ' + data.name + '</p>';
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

    //Pusher API
    var pusher = new Pusher('6a1122c0070c81d3d80a',{
        cluster: 'eu',
        encrypted: true}
    );
    var channel = pusher.subscribe('shoutbox');

    channel.bind('App\\Events\\ShoutWasFired', function(data){

        console.log(data);

        if(parseInt(data.shout.id)%2 == 0)
        {
            $('#shoutbox-chat').append("<li class='left clearfix'><span class='chat-img pull-left'><img src='/images/"+data.shout.profile_pic+"' width='50' alt='User Avatar' class='img-circle'/> \
            </span> \
            <div class='chat-body clearfix'> \
            <div class='header'> \
            <strong class='primary-font'>"+data.shout.name+"</strong> \
        <small class='pull-right text-muted'> \
            <span class='fa fa-clock-o'></span> "+data.shout.created_at+" \
        </small> \
        </div> \
        <p> \
        "+data.shout.message+" \
        </p> \
        </div> \
        </li>\
        ");
            $(".messageLog").animate({ scrollTop: $(".messageLog")[0].scrollHeight}, 1000);
        }
        else
        {
            $('#shoutbox-chat').append("<li class='right clearfix'><span class='chat-img pull-right'> \
        <img src='/images/"+data.shout.profile_pic+"' width='50' alt='User Avatar' class='img-circle'/> \
            </span> \
            <div class='chat-body clearfix'> \
            <div class='header'> \
            <small class='text-muted'><span class='fa fa-clock-o'></span> "+data.shout.created_at+" \
        </small> \
        <strong class='pull-right primary-font'>"+data.shout.name+"</strong> \
        </div> \
        <p class='text-right'> \
            "+data.shout.message+" \
        </p> \
        </div> \
        </li>");
            $(".messageLog").animate({ scrollTop: $(".messageLog")[0].scrollHeight}, 1000);
        }
    });

});