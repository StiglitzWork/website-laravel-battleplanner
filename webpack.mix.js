let mix = require('laravel-mix');
const webpack = require('webpack');

// Includes dependancies in all files
// Else plugins cannot inject themselves into jQuery
mix.webpackConfig({
  plugins: [
    new webpack.ProvidePlugin({
      '$': 'jquery',
      'jQuery': 'jquery',
      'window.jQuery': 'jquery',
      'bootstrap': 'bootstrap'
    })
  ]
});



// Main
mix.sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/js/global/*', 'public/js/global')

    // Assets and CSS
    .copy('resources/assets/media/*', 'public/media')
    .copy('resources/assets/media/thumbs/*', 'public/media/thumbs')
    .copy('resources/assets/media/maps/Bank/*', 'public/media/maps/Bank')
    .copy('resources/assets/media/maps/Border/*', 'public/media/maps/Border')
    .copy('resources/assets/media/maps/Coastline/*', 'public/media/maps/Coastline')
    .copy('resources/assets/media/maps/Consulate/*', 'public/media/maps/Consulate')
    .copy('resources/assets/media/maps/Chalet/*', 'public/media/maps/Chalet')
    .copy('resources/assets/media/maps/Clubhouse/*', 'public/media/maps/Clubhouse')
    .copy('resources/assets/media/maps/Kafe/*', 'public/media/maps/Kafe')
    .copy('resources/assets/media/maps/Oregon/*', 'public/media/maps/Oregon')
    .copy('resources/assets/media/maps/Skyscraper/*', 'public/media/maps/Skyscraper')
    .copy('resources/assets/media/maps/Villa/*', 'public/media/maps/Villa')
    .copy('resources/assets/media/maps/Theme Park/*', 'public/media/maps/Theme Park')
    .copy('resources/assets/media/maps/House/*', 'public/media/maps/House')
    .copy('resources/assets/media/maps/Yacht/*', 'public/media/maps/Yacht')
    .copy('resources/assets/media/maps/Favela/*', 'public/media/maps/Favela')
    .copy('resources/assets/media/maps/Tower/*', 'public/media/maps/Tower')
    .copy('resources/assets/media/maps/Plane/*', 'public/media/maps/Plane')
    .copy('resources/assets/media/maps/Bartlett/*', 'public/media/maps/Bartlett')
    .copy('resources/assets/media/maps/Hereford/*', 'public/media/maps/Hereford')
    .copy('resources/assets/media/maps/Kanal/*', 'public/media/maps/Kanal')
    .copy('resources/assets/media/ops/*', 'public/media/ops')
    .copy('resources/assets/media/tools/atk/*', 'public/media/tools/atk')
    .copy('resources/assets/media/tools/def/*', 'public/media/tools/def')
    .copy('resources/assets/sass/global/*', 'public/css/global');

// Index
mix.js('resources/assets/js/index/index.js', 'public/js/index')
    .copy('resources/assets/sass/index/*', 'public/css/index');

// Auth
mix.copy('resources/assets/js/login/*', 'public/js/login')
    .copy('resources/assets/sass/login/*', 'public/css/login')
    .copy('resources/assets/js/register/*', 'public/js/register')
    .copy('resources/assets/sass/register/*', 'public/css/register');

// Maps
// mix.js('resources/assets/js/maps/show.js', 'public/js/maps/show.bundle.js')
//     .copy('resources/assets/sass/maps/*', 'public/css/maps');

// Maps
mix.js('resources/assets/js/room/join.js', 'public/js/room/join.js')
    .js('resources/assets/js/room/index.js', 'public/js/room/index.js')
    .js('resources/assets/js/room/show.js', 'public/js/room/show.bundle.js')
    .copy('resources/assets/sass/room/*', 'public/css/room');
