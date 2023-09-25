let mix = require('laravel-mix');
require('mix-tailwindcss');

mix.js('resources/js/app.js', 'src/web/assets/dist/PluginBundle.js')
    .sass('resources/sass/app.scss', 'src/web/assets/dist/PluginBundle.css')
    .tailwind();