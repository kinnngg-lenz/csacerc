var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.sass('app.scss');
    mix.less('app.less');

    mix.styles(['bootstrap.css', 'highlight/railscasts.css', ,'bootstrap-datetimepicker.min.css', 'bubble.css', 'app.css'],null,'public/css');

    //@TODO: Try to remove vue.min.js, jquery.carouFredSel-6.2.0-packed.js
    mix.scripts(['jquery.min.js', 'bootstrap.min.js', 'modernizr.js', 'typeahead.bundle.min.js', 'masonry.pkgd.min.js', 'jquery.imagesloaded.js', 'bootstrap-datetimepicker.min.js', 'jquery.countdown2.js', 'jquery.flexslider-min.js', 'app.js'],null,'public/js');

    mix.version(['css/all.css','js/all.js']);
});
