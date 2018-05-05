let mix = require("laravel-mix");
const OfflinePlugin = require("offline-plugin");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
  .js("resources/assets/js/app.js", "public/js")
  .sass("resources/assets/sass/app.scss", "public/css")
  .extract(["vue", "axios", "lodash", "chart.js"])
  .version()
  .disableNotifications();

mix.webpackConfig({
  plugins: [
    new OfflinePlugin({
      externals: ["/"],
      ServiceWorker: {
        entry: "./resources/assets/js/webpush.js",
        navigateFallbackURL: "/",
        events: true,
        minify: true
      }
    })
  ]
});
