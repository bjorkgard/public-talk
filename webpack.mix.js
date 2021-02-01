const mix = require('laravel-mix');
require('laravel-mix-polyfill')

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

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .extract()
    .polyfill({
        enabled: mix.inProduction(),
        useBuiltIns: 'usage',
        targets: 'defaults',
        corejs: 3,
        debug: false // "true" to check which polyfills are being used
    })
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}
