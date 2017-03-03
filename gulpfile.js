var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix
        .scripts([
            '../../../node_modules/jquery/dist/jquery.min.js',
            '../../../node_modules/moment/moment.js',
            '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
            '../../../node_modules/jquery-ui-dist/jquery-ui.js',
            '../../../node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            'app.js',
            'bootstrap-editable.js',
            'jquery.validate.min.js',
            'bootstrap-confirmation.min.js',
            'bootstrap-growl.min.js',
        ], 'public/js/all.js')
        .sass('app.scss', 'public/css/app.css')
        .styles('theme/*.css', 'public/css/theme.css')
        .version([
            'public/css/app.css',
            'public/css/bootstrap-editable.css',
            'public/css/theme.css',
            'public/js/all.js',
            'public/js/bootstrap-editable.js',
            'public/js/jquery.validate.min.js',
            'public/js/bootstrap-confirmation.min.js',
            'public/js/bootstrap-growl.min.js',
        ]);

    mix
        .copy(
            [
                'node_modules/font-awesome/fonts',
                'node_modules/bootstrap-sass/assets/fonts'
            ],
            'public/build/fonts'
        )
        .copy(
            'resources/assets/css/auth/main.css',
            'public/css'
        )
});

//created pages, navbar, create forms