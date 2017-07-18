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
    if (elixir.config.production) {
      process.env.NODE_ENV = 'production';
    }

    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts')
    .copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'public/css')
    .copy('node_modules/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/css')
    
    .browserify('main.js', 'public/js/main.js')
    
    .sass('app.scss')
    .scripts([
        'newRem.js',
        'swiper.js',
        'zepto.min.js'
    ], 'public/js/app.js')
    .version([
        'css/app.css',
        'css/index.css',
        'css/licence.css',
        'js/app.js',
        'js/main.js',
    ])
});
