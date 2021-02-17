const mix = require('laravel-mix');
const LiveReloadPlugin = require('webpack-livereload-plugin');

// Определяем важные пути
const resources_path = './wp-content/themes/classy/';

// Куда копировать ресурсы из CSS
mix.setPublicPath(resources_path + 'dist');

// Автоподмена пути к ресурсам в cSS
mix.setResourceRoot(resources_path + 'dist');

mix.options({
    processCssUrls: false,
    legacyNodePolyfills: false,
    autoprefixer: {
        cascade: false,
        grid: 'autoplace',
    }
});

mix.disableSuccessNotifications();

mix.webpackConfig({
    plugins: [
        //new LiveReloadPlugin() // not working
    ],
    module: {
        rules: [
            // Для маски - @import "blocks/**/*.scss"
            {
                test: /\.scss$/,
                loader: 'import-glob-loader',
            },
            // fix excluding
            /*{
                test: /\.jsx?$/,
                exclude: /(bower_components)/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: mix.config.babel(),
                    }
                ]
            }*/
        ]
    }
});

// JS
mix.js(resources_path + 'assets/js/index.js', resources_path + 'dist').vue().autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
})

    // SASS
    .sass(resources_path + 'assets/sass/main.scss', resources_path + 'dist/main.css')
    .sass(resources_path + 'assets/sass/admin.scss', resources_path + 'dist/admin.css')
    //.sass(resources_path + 'sass/print.scss', 'dist')

    // Generate sourceMaps
    .sourceMaps(false, 'source-map')

    // Add hash version to file {{ mix('/css/app.css') }}
    .copy(resources_path + 'assets/img', resources_path + 'dist/img')
    .copy(resources_path + 'assets/fonts', resources_path + 'dist/fonts')
    .version();
