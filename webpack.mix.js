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
        }),
        // "@babel/plugin-syntax-dynamic-import",
        // new webpack.optimize.ModuleConcatenationPlugin()
    ]
});

// Main
mix.sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/js/global/*', 'public/js/global')

    // Assets and CSS
    .copy('resources/assets/media/*', 'public/media')
    .copy('resources/assets/media/thumbs/*', 'public/media/thumbs')
    .copy('resources/assets/media/maps/Clean/Bank/*', 'public/media/maps/Clean/Bank')
    .copy('resources/assets/media/maps/Clean/Border/*', 'public/media/maps/Clean/Border')
    .copy('resources/assets/media/maps/Clean/Coastline/*', 'public/media/maps/Clean/Coastline')
    .copy('resources/assets/media/maps/Clean/Consulate/*', 'public/media/maps/Clean/Consulate')
    .copy('resources/assets/media/maps/Clean/Chalet/*', 'public/media/maps/Clean/Chalet')
    .copy('resources/assets/media/maps/Clean/Clubhouse/*', 'public/media/maps/Clean/Clubhouse')
    .copy('resources/assets/media/maps/Clean/Fortress/*', 'public/media/maps/Clean/Fortress')
    .copy('resources/assets/media/maps/Clean/Kafe/*', 'public/media/maps/Clean/Kafe')
    .copy('resources/assets/media/maps/Clean/Oregon/*', 'public/media/maps/Clean/Oregon')
    .copy('resources/assets/media/maps/Clean/Skyscraper/*', 'public/media/maps/Clean/Skyscraper')
    .copy('resources/assets/media/maps/Clean/Villa/*', 'public/media/maps/Clean/Villa')
    .copy('resources/assets/media/maps/Clean/Theme Park/*', 'public/media/maps/Clean/Theme Park')
    .copy('resources/assets/media/maps/Clean/House/*', 'public/media/maps/Clean/House')
    .copy('resources/assets/media/maps/Clean/Yacht/*', 'public/media/maps/Clean/Yacht')
    .copy('resources/assets/media/maps/Clean/Favela/*', 'public/media/maps/Clean/Favela')
    .copy('resources/assets/media/maps/Clean/Tower/*', 'public/media/maps/Clean/Tower')
    .copy('resources/assets/media/maps/Clean/Plane/*', 'public/media/maps/Clean/Plane')
    .copy('resources/assets/media/maps/Clean/Bartlett/*', 'public/media/maps/Clean/Bartlett')
    .copy('resources/assets/media/maps/Clean/Hereford/*', 'public/media/maps/Clean/Hereford')
    .copy('resources/assets/media/maps/Clean/Kanal/*', 'public/media/maps/Clean/Kanal')
    .copy('resources/assets/media/ops/*', 'public/media/ops')
    .copy('resources/assets/media/tools/general/*', 'public/media/tools/general')
    .copy('resources/assets/media/tools/secondary/*', 'public/media/tools/secondary')
    .copy('resources/assets/media/tools/unique/*', 'public/media/tools/unique')
    .copy('resources/assets/sass/global/*', 'public/css/global');

// Index
mix.js('resources/assets/js/index/index.js', 'public/js/index')
    .copy('resources/assets/sass/index/*', 'public/css/index');

// Auth
mix.copy('resources/assets/js/login/*', 'public/js/login')
    .copy('resources/assets/sass/login/*', 'public/css/login')
    .copy('resources/assets/js/register/*', 'public/js/register')
    .copy('resources/assets/sass/register/*', 'public/css/register');

// Rooms
mix.js('resources/assets/js/room/join.js', 'public/js/room/join.js')
    .js('resources/assets/js/room/index.js', 'public/js/room/index.js')
    .js('resources/assets/js/room/sidebar.js', 'public/js/room/sidebar.js')
    .js('resources/assets/js/room/show.js', 'public/js/room/show.bundle.js')
    .copy('resources/assets/sass/room/*', 'public/css/room');

// Battleplan
mix.copy('resources/assets/js/battleplan', 'public/js/battleplan')
    .copy('resources/assets/sass/battleplan/*', 'public/css/battleplan');