const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    // .js('resources/js/helloWorld.js', 'public/js') // この行を追加
    .js('resources/js/chartjs.js', 'public/js') // この行を追加
    // .copy('resources/js/app.js', 'public/js') // この行を追加
    .sass('resources/sass/app.scss', 'public/css')
    .version();