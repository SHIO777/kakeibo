let mix = require('laravel-mix');

// mix.js('resources/js/test.js', 'public/js').version();
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/chartjs.js', 'public/js')
    .js('resources/js/test.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]).version(); // この行を追加
