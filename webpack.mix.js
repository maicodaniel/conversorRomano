// webpack.mix.js

const mix = require('laravel-mix');

mix
    // .styles(
    //     [
    //         'resources/views/layout/css/style.css'
    //     ],
    //     'public/css/style.css'
    // )
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/site/bootstrap.css')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/site/bootstrap.js')
    .scripts('node_modules/jquery/dist/jquery.js', 'public/site/jquery.js')
    .version();



// let mix = require('laravel-mix');
//
// mix
//     .js('src/app.js', 'dist').setPublicPath('dist')
//     .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/site/bootstrap.css')
// ;
