// webpack.mix.js
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue() // Enable Vue compilation
    .sass('resources/sass/app.scss', 'public/css');