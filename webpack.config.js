const Encore = require('@symfony/webpack-encore');
const glob = require("glob");

Encore
// directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // public path used by the web server to access the output path
  .setPublicPath('/build')
  // only needed for CDN's or sub-directory deploy
  //.setManifestKeyPrefix('build/')

  /*
   * ENTRY CONFIG
   *
   * Add 1 entry for each "page" of your vue
   * (including one that's included on every page - e.g. "vue")
   *
   * Each entry will result in one JavaScript file (e.g. appVue.js)
   * and one CSS file (e.g. vue.css) if you JavaScript imports CSS.
   */
  .addStyleEntry('stylesheets/app', './assets/stylesheets/app.scss')
  .addEntry('javascripts/app', './assets/javascripts/app.js')
  .addEntry('javascripts/app.vue', './assets/javascripts/app.vue.js')
  .addEntry('images', glob.sync('./assets/images/*'))

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page vue
  .disableSingleRuntimeChunk()

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()

  // allow legacy applications to use $/jQuery as a global variable
  .autoProvidejQuery()

  // enable Vue.js
  .enableVueLoader()

  // enables Sass/SCSS support
  .enableSassLoader()

  // allow postcss & autoprefixer
  .enablePostCssLoader((options) => {
    options.config = {
      path: 'postcss.config.js'
    };
  })
  .enableSourceMaps(!Encore.isProduction())
  // ... but you can override it by passing a boolean value
  .enableSourceMaps(true)
  // enables hashed filenames (e.g. vue.abc123.css)
  .configureFilenames({
    js: '[name].js',
    css: '[name].css',
    images: 'images/[name].[ext]',
    fonts: 'fonts/[name].[ext]'
  })
  .enableVersioning(Encore.isProduction())
;

// export the final configuration
let config = Encore.getWebpackConfig();

module.exports = config;
