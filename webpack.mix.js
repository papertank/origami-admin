let mix = require('laravel-mix');

mix.options({ publicPath: 'public/assets' });
mix.setResourceRoot('/assets/');

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

mix.sass('resources/assets/sass/admin.scss', 'public/assets/css')
    .js('resources/assets/js/admin.js', 'public/assets/js');

// mix.browserSync({
//     proxy: 'admin.test',
//     files: [
//         'public/**/*.js',
//         'public/**/*.css'
//     ]
// });
