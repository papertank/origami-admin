const mix = require('laravel-mix');

mix.options({ publicPath: 'public' });

mix.version();

mix.js('resources/js/vendor.js', 'public/js');

mix.sass('resources/sass/admin.scss', 'public/css')
    .js('resources/js/admin.js', 'public/js');
