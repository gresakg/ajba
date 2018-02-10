var gulp 		= require('gulp');

var cssimport	= require('gulp-cssimport');
var cleancss	= require('gulp-clean-css');
var less 		= require('gulp-less');
var path 		= require('path');
var plumber 	= require('gulp-plumber');
var concat 		= require('gulp-concat');
var rename 		= require('gulp-rename');
var jshint 		= require('gulp-jshint');
var uglify		= require('gulp-uglify');
var livereload	= require('gulp-livereload');
var bump 		= require('gulp-bump');

var options 	= {};

gulp.task('import',function(){
	gulp.src('./node_modules/purecss/build/base.css')
	.pipe(cssimport(options))
	.pipe(gulp.dest("src/css/"))
	;
	gulp.src('./node_modules/purecss/build/menus.css')
	.pipe(cssimport(options))
	.pipe(gulp.dest("src/css/"))
	;
});

gulp.task('less', function() {
	return gulp.src('src/less/index.less')
	.pipe(plumber())
	.pipe(less({
		paths: [
		path.join(__dirname,'./node_modules/font-awesome/less/'),
		path.join(__dirname,'./src/css/')]
	}))
	.pipe(gulp.dest('./css'))
	.pipe(concat('styles.css'))
	.pipe(cleancss())
	.pipe(rename({
		suffix:'.min'
	}))
	.pipe(gulp.dest('./css'))
	.pipe(livereload())
	;
});

gulp.task('scripts', function() {
	return gulp.src(['src/js/*.js'])
	.pipe(jshint())
	.pipe(concat('all.js'))
	.pipe(gulp.dest('./js'))
	.pipe(rename('all.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./js'))
	;
});

gulp.task('bump', function(){
  gulp.src('./style.css')
  .pipe(bump())
  .pipe(gulp.dest('./'));
});

gulp.task('watch',function() {
	livereload.listen();
	gulp.watch('**/*.php', livereload.reload);
	gulp.watch('src/js/*.js',['scripts','bump'], livereload.reload);
	gulp.watch('src/less/*.less',['less','bump'], livereload.reload);
});

gulp.task('default',['less','scripts','bump','watch']);