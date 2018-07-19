let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Main
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/js/global/*', 'public/js/global')
    .copy('resources/assets/media/*', 'public/media')
    .copy('resources/assets/media/thumbs/*', 'public/media/thumbs')
    .copy('resources/assets/media/maps/*', 'public/media/maps')
    .copy('resources/assets/media/ops/*', 'public/media/ops')
    .copy('resources/assets/media/tools/atk/*', 'public/media/tools/atk')
    .copy('resources/assets/media/tools/def/*', 'public/media/tools/def')
    .copy('resources/assets/sass/global/*', 'public/css/global');

// Index
mix.copy('resources/assets/js/index/*', 'public/js/index')
    .copy('resources/assets/sass/index/*', 'public/css/index');

// Auth
mix.copy('resources/assets/js/login/*', 'public/js/login')
    .copy('resources/assets/sass/login/*', 'public/css/login')
    .copy('resources/assets/js/register/*', 'public/js/register')
    .copy('resources/assets/sass/register/*', 'public/css/register');