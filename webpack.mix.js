const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss','public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('autoprefixer'),
    ])
    .scripts([
        'resources/js/jCookie.js',
        'resources/js/datatableformhandling.js'
    ], 'public/js/datatableformhandling.min.js')
    .extract([
        'jquery',
        'axios',
        'lodash',
        'moment',
        'popper.js',
        'bootstrap',
        'simplebar',
        'feather-icons',
    ],'public/core/core')
    .extract([
        'bootstrap-daterangepicker',
        'bootstrap-table',
        'tom-select',
        'daterangepicker',
        'gijgo',
        'sweetalert2',
    ],'public/core/bootstrap')
    .extract([
        'codemirror',
        'simplemde',
        'summernote'
    ],'public/core/editor')
    .extract()
    ;
if (mix.inProduction()) {
    mix.version();
}
