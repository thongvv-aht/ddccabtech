var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function(){
	gulp.src('./scss/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./scss/'));
});

gulp.task('sass:watch', function(){
	gulp.watch('./scss/**/*.scss', ['sass']);
});