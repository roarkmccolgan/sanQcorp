const cssImport = require('postcss-import')
const cssNesting = require('postcss-nesting')
const mix = require('laravel-mix');
const path = require('path')
const tailwindcss = require('tailwindcss')

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
 	.vue()
	.copyDirectory('node_modules/literallycanvas/lib/img', 'public/lc-assets/img')
	.postCss('resources/css/app.css', 'public/css', [
		cssImport(),
    	cssNesting(),
    	tailwindcss('tailwind.config.js'),
	])
	.webpackConfig({
		output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
		resolve: {
			alias: {
				'vue$': 'vue/dist/vue.runtime.esm.js',
				'@': path.resolve('resources/js'),
			},
		},
	})
 	.babelConfig({
 		plugins: ['@babel/plugin-syntax-dynamic-import']
 	})
 	.version()
 	.sourceMaps();

 if (mix.inProduction()) {
 	mix
 	.purgeCss();
 }
