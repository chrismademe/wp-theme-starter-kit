// Config
const config = {
	source: 'assets/sass',
	dest: 'assets/css',
	js: 'assets/js'
};

// Modules
const gulp = require('gulp');
const sass = require('gulp-sass');
const sassglob = require('gulp-sass-glob');
const minifycss = require('gulp-cssnano');
const plumber = require('gulp-plumber');
const exportSass = require('node-sass-export');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');

sass.compiler = require('sass');

/**
 * Default Task that runs when you type gulp in the console
 */
const defaultTask = function (done) {
	gulp.series('compileSass', 'watch');
	done();
};

/**
 * Compile SASS
 *
 * Compiles your SASS files in to one stylesheet
 */
const compileSass = function () {
	return (
		gulp
			.src([`${config.source}/*.scss`, `${config.source}/**/*.scss`])

			// Compile SASS
			.pipe(sassglob())
			.pipe(
				sass({
					// outputStyle: `expanded`,
					includePaths: [`${config.source}`],
					functions: exportSass('.')
				}).on('error', sass.logError)
			)
			.pipe(plumber())

			// Minify
			.pipe(minifycss())

			// Save it and update the browser
			.pipe(gulp.dest(config.dest))
	);
};

/**
 * Minify Javascript
 *
 * Minify Javascript files
 */
const minifyJS = function () {
	// Get JS Files
	return (
		gulp
			.src([config.js + '/*.js', '!' + config.js + '/*.min.js'])

			// Check for errors
			.pipe(plumber())

			// Minify
			.pipe(uglify())

			// Add .min to the filename
			.pipe(
				rename(function (path) {
					path.basename += '.min';
				})
			)

			// Save!
			.pipe(gulp.dest(config.js))
	);
};

function watch(done) {
	// Watch .scss files
	gulp.watch([`${config.source}/*.scss`, `${config.source}/**/*.scss`, `${config.source}/**/**/*.scss`], compileSass);

	done();
}

const watchAndSync = gulp.parallel(watch);

exports.default = defaultTask;
exports.compileSass = compileSass;
exports.watch = watchAndSync;
exports.minifyJS = minifyJS;
