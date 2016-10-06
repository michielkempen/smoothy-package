const elixir = require('laravel-elixir');

require('laravel-elixir-browserify-official');
require('laravel-elixir-vueify');

elixir(mix => {

    mix.sass([
        'app.scss'
    ]);

    mix.browserify('app.js');

    mix.version([
        'css/app.css',
        'js/app.js'
    ]);

    mix.browserSync({
    	'proxy': ''
    });
    
});