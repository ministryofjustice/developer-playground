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

mix.js(['resources/js/icons.js', 'resources/js/app.js'], 'public/assets/js/app.js')
    .js('node_modules/jquery/dist/jquery', 'public/assets/js')
    .sass('resources/sass/app.scss', 'public/assets/css')
    .copy('node_modules/govuk-frontend/govuk/all.js', 'public/assets/js/govuk.js')
    .copy('node_modules/chart.js/dist/chart.js', 'public/assets/js/')
    .copy('node_modules/govuk-frontend/govuk/assets/images', 'public/assets/images')
    .copy('node_modules/govuk-frontend/govuk/assets/fonts', 'public/assets/fonts')
    .copy('resources/chart*', 'public/assets')
    .copy('resources/judiciary-icon.png', 'public/assets');
