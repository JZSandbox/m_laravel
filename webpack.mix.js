const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/admin_login/index.scss', 'public/css/admin_login')
    .sass('resources/sass/admin_login/register/index.scss', 'public/css/admin_register')
    .sass('resources/sass/admin_login/registercompany/index.scss', 'public/css/admin_register/company')
    .sass('resources/sass/dashboard/index.scss', 'public/css/dashboard')
    .sass('resources/sass/table/index.scss', 'public/css/dashboard/table')
    .sourceMaps();
