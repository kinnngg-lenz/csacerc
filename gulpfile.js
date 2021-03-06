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

    mix.styles(['bootstrap.css', 'highlight/railscasts.css', 'bootstrap-datetimepicker.min.css', 'bubble.css', 'select2.css', 'jquery.textcomplete.css', 'app.css'],null,'public/css');

    mix.scripts(['jquery.min.js', 'bootstrap.min.js', 'modernizr.js', 'typeahead.bundle.min.js', 'masonry.pkgd.min.js', 'jquery.imagesloaded.js', 'bootstrap-datetimepicker.min.js', 'jquery.countdown2.js', 'jquery.flexslider-min.js', 'select2/select2.full.min.js', 'autosize.min.js', 'jquery.textcomplete.min.js', 'app.js'],null,'public/js');

    mix.version(['css/all.css','js/all.js']);
});
