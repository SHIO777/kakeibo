let mix = require('laravel-mix');

// mix.js('resources/js/test.js', 'public/js').version();
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/test.js', 'public/js')
    // .js('resources/js/app.js', 'public/js')
    .version(); // この行を追加
