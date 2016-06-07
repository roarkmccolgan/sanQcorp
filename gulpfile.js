var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

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
    mix.browserify('main.js')
    .sass('app.scss')
    .copy('node_modules/literallycanvas/lib/img', 'public/img/vendor/literallycanvas')
    /*.scripts(['literallycanvas.js'], 'public/js/vendor/literallycanvas.js')*/;
});
