let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
const resolve = require('path').resolve;

mix.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css').options({
		processCssUrls: false,
		postCss: [tailwindcss('tailwind.config.js')],
	});

mix.webpackConfig({
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js/'),
            '~': resolve(__dirname, 'resources/js/'),
            '@Components': resolve(__dirname, 'resources/js/Components'),
            '@Pages': resolve(__dirname, 'resources/js/Pages')
        }
    },
	module: {
		rules: [
			{
				enforce: 'pre',
				exclude: /node_modules/,
				loader: 'eslint-loader',
				test: /\.(js|vue)?$/
			},
		]
	},
	output: {
		chunkFilename: 'js/[name].[chunkhash].js',
	},
});

mix.disableNotifications();
mix.sourceMaps();
