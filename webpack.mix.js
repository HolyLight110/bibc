const mix = require('laravel-mix');

// mix.setPublicPath('../');
// mix.setResourceRoot('../');

mix.js('resources/js/app.js', 'resources/assets/js')
   .sass('resources/sass/app.scss', 'resources/assets/css');