$(document).ready(function(){
   $(window).bind('scroll', function(){
       var navHeight = 280;
       if($(window).scrollTop() > navHeight)
       {
           $('.navbar-scroll').addClass('navbar-fixed-top');
           $('.navbar-scroll').removeClass('navbar-static-top');
       }
       else
       {
           $('.navbar-scroll').removeClass('navbar-fixed-top');
           $('.navbar-scroll').addClass('navbar-static-top');
       }
   });
});