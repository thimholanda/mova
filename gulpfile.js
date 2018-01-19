var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var imagemin = require('gulp-imagemin');
var changed  = require('gulp-changed');

gulp.task('sass', function () {
  return gulp.src('./resources/assets/sass/**/*.sass')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('./public/css'));
});
     
gulp.task('browser-sync', function() {
    browserSync.init(['./*.json', './public/css/**', './public/js/**', './**/*.php', './**/*.html'], {
        proxy: 'http://127.0.0.1:8000/',
        browser: 'chrome'
    });
});

gulp.task('default', ['sass', 'browser-sync'], function () { 
    gulp.watch('./resources/assets/sass/**/*.sass', ['sass']);
});