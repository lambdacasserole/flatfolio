// Imports.
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

/**
 * Compiles the project's SASS.
 */
gulp.task('sass', function() {
    return gulp.src('public/css/*.scss')
        .pipe(sass({ style: 'compressed' }))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('public/css'))
});

gulp.task('default', ['sass']);
