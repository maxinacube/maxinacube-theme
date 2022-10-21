'use strict';


const { task, src, series, parallel, watch, dest } = require( 'gulp' );
const yargs        = require( 'yargs' );
const fs           = require( 'fs-extra' );
const webpack      = require( 'webpack-stream' );
const uglify       = require( 'gulp-uglify' );
const sass         = require( 'gulp-sass' )( require( 'sass' ) );
const gif          = require( 'gulp-if' );
const log          = require( 'fancy-log' );
const postcss      = require( 'gulp-postcss' );
const sourcemaps   = require( 'gulp-sourcemaps' );
const autoprefixer = require( 'autoprefixer' );

let config       = {};
let isProduction = !!( yargs.argv.production ); // Check for --production flag

/**
 * Load our configuration from package.json
 *
 * @since 1.5.0 Updated to load config from package.json instead of config.yml
 *
 * @since 1.0.0
 *
 * @param done
 */
const loadConfig = ( done ) => {
	fs.readJson( './package.json' )
		.then( packageObj => {
			config                 = packageObj.buildconfig;
			config.webpack.mode    = ( isProduction ? 'production' : 'development' );
			config.webpack.devtool = ! isProduction && 'source-map'
			config.webpack.module.rules[0].use.options.compact = ( isProduction );
			done();
		})
		.catch( err => {
			log(err);
			done();
		} );
}

/**
 * Define our sass configuration
 *
 * @since 1.0
 *
 * @type {{mode: (boolean)}}
 */
let sassConfig = {
	mode: ( isProduction )
};

/**
 * Cleanup compiled assets.
 */
const clean = ( done ) => {
	fs.remove( 'js', done );
	fs.remove( 'css', done );
}


/**
 * Set production mode during the build process
 *
 * @param done
 */
const setProductionMode = ( done ) => {
	isProduction           = true;
	config.webpack.mode    = 'production';
	config.webpack.devtool = false;
	sassConfig.mode        = true;
	done();
}

/**
 * Watch for changes to assets
 * Sass
 * JavaScript
 *
 * @since 1.5.0
 */

const watchChanges = () => {
	watch( config.gulp.javascript.assets ).on(
		'all',
		series( javascript )
	);

	watch( config.gulp.sass.assets ).on(
		'all',
		series( buildSass )
	);

	watch(config.gulp.blockSass.blocks).on(
		'all',
		series(buildBlockSass)
	);
}


/**
 * Copy files out of the assets folder
 * This task skips over the "img", "js", and "scss" folders, which are parsed separately
 *
 * @since 1.0
 *
 * @return {*}
 */
const copy = () => {
	return src( config.gulp.fonts.assets ).pipe( dest( config.gulp.fonts.dest ) );
}

/**
 * Build our Sass into css
 * When in production mode, compress and do not use sourcemaps
 *
 * @since 1.0
 *
 * @return {*}
 */
const buildSass = () => {

	const postCssPlugins = [
		// Autoprefixer
		autoprefixer(),
	].filter(Boolean);

	return src( config.gulp.sass.assets )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			includePaths: config.gulp.sass.assets
		}).on('error', sass.logError ) )
		.pipe( postcss( postCssPlugins ) )
		.pipe( gif(!sassConfig.mode, sourcemaps.write() ) )

		.pipe( dest( config.gulp.sass.dest ) );
}

/**
 * Build our Block Sass
 *
 * @since 1.0
 *
 * @return {*}
 */
const buildBlockSass = () => {

	const postCssPlugins = [
		// Autoprefixer
		autoprefixer(),
	].filter(Boolean);

	return src(config.gulp.blockSass.blocks)
		.pipe(sourcemaps.init())
		.pipe(sass({
			includePaths: config.gulp.blockSass.blocks
		}).on('error', sass.logError))
		.pipe(postcss(postCssPlugins))
		.pipe(gif(!sassConfig.mode, sourcemaps.write()))
	
		.pipe(dest(config.gulp.blockSass.dest));
}

/**
 * In production, the file is minified
 *
 * @since 1.0
 *
 * @return {*}
 */
const javascript = () => {
	return src( config.gulp.javascript.assets, { sourcemaps: isProduction } )
		.pipe( webpack( config.webpack ) )
		.pipe(
			gif(
				isProduction,
				uglify().on( 'error', console.log )
			) )
		.pipe( dest( config.gulp.javascript.dest ) );

}

// Build the "dist" folder by running the tasks below
// Sass must be run later so UnCSS can search for used classes in the others assets.
task('build:production',
	series(
		loadConfig,
		setProductionMode,
		clean,
		javascript,
		buildSass,
		buildBlockSass
	)
);

// Build the site and watch for file changes
task( 'default',
	series(
		loadConfig,
		clean,
		javascript,
		buildSass,
		buildBlockSass,
		parallel( watchChanges )
	)
);
