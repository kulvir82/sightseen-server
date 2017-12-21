let mix = require('laravel-mix');

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

   mix.autoload({ jquery: ['$', 'window.jQuery', 'jQuery'],
                  'popper.js/dist/umd/popper.js': ['Popper']
                })
      .js(['node_modules/popper.js/dist/umd/popper.min.js',
           'resources/assets/js/app.js',
           'resources/assets/js/bootstrap.js',
           'resources/assets/js/front/custom.js',
           'resources/assets/js/front/new-age.min.js'
        ], 'public/js/app.js')
      .sass('resources/assets/sass/app.scss', 'public/css')
      .scripts(['resources/assets/js/jquery.filer.min.js'
             ], 'public/js/main.js')
      .styles([
       'resources/assets/css/global.css',
       'resources/assets/css/pagination.css',
      ],'public/css/app.css')
      .styles(['resources/assets/css/device-mockups_css/device-mockups.css',
               'node_modules/bootstrap/dist/css/bootstrap.min.css',
               'node_modules/font-awesome/css/font-awesome.min.css',
               'resources/assets/css/frontcss/new-age.min.css',
               'resources/assets/css/frontcss/custom.css',
               'node_modules/bootstrap-vue/dist/bootstrap-vue.css',
               'node_modules/simple-line-icons/css/simple-line-icons.css'
             ],'public/css/front.css');
