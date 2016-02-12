/**
 * Created by Zishan on 08-Feb-16.
 */
$(document).ready(function(){
   $('.notification').delay(2000).slideUp(1000);
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

    $('#navsearch').typeahead({
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

    $('.spin').hover(function(){
            $(this).children().children().addClass('fa-spin')
    },
        function () {
            $(this).children().children().removeClass('fa-spin')
        });
/*
    $(this).hover(


    );*/

});