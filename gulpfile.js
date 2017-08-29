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
    .styles([
        '/resources/assets/css/modules/page-loader.css',
        '/resources/assets/css/modules/summernote.css',
        '/public/css/app.css'
    ], 'public/css/main.css', './')
    .copy('node_modules/literallycanvas/lib/img', 'public/img/vendor/literallycanvas')
    .copy('node_modules/sweetalert2/dist/', 'public/css/vendor/sweetalert2')
    //.copy('node_modules/ckeditor/', 'public/js/vendor/ckeditor')
    .copy('node_modules/summernote/dist/', 'public/js/vendor/summernote')
    /*.scripts(['literallycanvas.js'], 'public/js/vendor/literallycanvas.js')*/
    .version(['public/css/main.css','public/js/main.js']);
});
