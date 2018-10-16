var gulp         = require('gulp');
var browserSync  = require('browser-sync').create();
var sass         = require('gulp-sass');
var cleanCSS     = require('gulp-clean-css');
var rename       = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');

var styleSRC     = 'scss/**/*.scss';
var styleDEST    = 'css';


// Compile todo: enable error messages
gulp.task('compile', function() {
    return gulp.src( [styleSRC] )
        .pipe( sass())
        .pipe( autoprefixer ({
            browsers: ['last 2 versions'],
            cascade: false
        }) )
        .pipe( gulp.dest( styleDEST ) );
});


// Watch
gulp.task('watch', ['compile'], function() {
    gulp.watch( [styleSRC], ['compile'] );
});


// Watch & Sync
gulp.task('sync', ['compile'], function() {
    browserSync.init({
        proxy: 'http://localhost/zbradu/',
        browser: "firefox"
    });

    gulp.watch( [styleSRC], ['compile'] );
    gulp.watch( ["*.php", "**/*.css"] ).on( 'change', browserSync.reload );
});


// Minify CSS
gulp.task('minify', function() {
    return gulp.src('css/zbradu.css')
        .pipe( sourcemaps.init() )
        .pipe( cleanCSS({ compatibility: 'ie8' }) )
        .pipe( rename({ suffix: '.min' }) )
        .pipe( sourcemaps.write( './' ))
        .pipe( gulp.dest( styleDEST ) );
});


// Default Task
gulp.task('default', ['watch']);