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
    .sass('resources/sass/app.scss', 'public/css')
    .extract([
      'vue',
    	'vuex',
    	'vue-router',
      'vuetify',
      'vuetify/es5/util/colors',
      //'axios',
      //'lodash',
      //'moment'
    ])
    .version();

mix.browserSync({
  proxy: 'mylog.test'
});