var gulp = require('gulp');
var rename = require("gulp-rename");
var minify = require('gulp-minify-css');


gulp.task('css', function(){
   gulp.src('stylesheets/src/*.css')
   .pipe(minify())
   .pipe(rename({ suffix: '.min' }))
   .pipe(gulp.dest('stylesheets/min/'));
});

gulp.task('default',['css'],function(){
});