var gulp = require('gulp'),
	autoprefixer = require('autoprefixer'),
	browserSync = require('browser-sync').create(),
	postcss = require('gulp-postcss'),
	sass = require('gulp-dart-sass'),
	sourcemaps = require('gulp-sourcemaps'),

	// variables for the working theme folder
	root = './',
	scss = root + 'sass/';


// CSS via Sass and Autoprefixer
gulp.task('css', function () {
	return gulp.src(scss + '{style.scss,woocommerce.scss}')
	    .pipe(sourcemaps.init())
	    .pipe(sass({
			outputStyle: 'expanded',
			precision: 10,
			indentType: 'tab',
			indentWidth: '1'
	    }).on('error', sass.logError))
	    .pipe(postcss([ autoprefixer() ]))
	    .pipe(sourcemaps.write('./sass'))
	    .pipe(gulp.dest(root));
});

// Watch everything
gulp.task('watch', function () {
	gulp.watch( [ root + '**/*.scss' ], gulp.series('css') );
	// BrowserSync ***UPDATE PROXY & PORT***
	browserSync.init({
		open: 'external',
		proxy: 'http://localhost/westcozy',
		port: 8080
	});
	gulp.watch(root + '**/*').on('change', browserSync.reload);
});

// Default task that runs when running 'npx gulp'
gulp.task( 'default', gulp.series('css', 'watch') );
