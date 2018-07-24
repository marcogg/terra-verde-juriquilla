'use strict';

//Aqui invocamos gulp y el paquete de minificar
var gulp = require('gulp');
var sass = require('gulp-sass');
var rtlcss = require("gulp-rtlcss");
var rename = require("gulp-rename");
var pump = require('pump');
var minjs=require('gulp-uglify');



//Aqui establecimos la tarea de minificar
gulp.task('mainminjs', function(){
  gulp.src('assets/plugins/bootstrap/css/*.css') //decimos la ruta del archivo a minificar
  .pipe(minjs())
  .pipe(gulp.dest('assets/plugins/bootstrap/css/')); //le decimos el destino del archivo ya minificado
});


//Esta tarea hace update de los cambios que se hacen de forma automática
gulp.task('varmainjs', function(){
  gulp.watch('./src/js/*.js',['mainminjs']);
});

gulp.task('sass', function () {
	gulp.src('./sass/**/*.scss')
		.pipe(sass())
		.pipe(gulp.dest('./assets/base/css/'));
});

gulp.task('sass:watch', function () {
	gulp.watch('./sass/**/*.scss', ['sass']);
});

gulp.task('compress', function (cb) {
  pump([
        gulp.src('assets/plugins/bootstrap/css/*.css'),
        uglify(),
        gulp.dest('assets/plugins/bootstrap/css/')
    ],
    cb
  );
});

var prettify = require('gulp-prettify');
 
gulp.task('prettify', function() {
  gulp.src('../../master/release/theme/*.html')
    .pipe(prettify({
    	indent_size: 4, 
    	indent_inner_html: true,
    	unformatted: ['pre', 'code']
   	}))
    .pipe(gulp.dest('../../master/release/theme/'))
});

gulp.task('prettify-rtl', function() {
  gulp.src('../../master/release/theme_rtl/*.html')
    .pipe(prettify({
      indent_size: 4, 
      indent_inner_html: true,
      unformatted: ['pre', 'code']
    }))
    .pipe(gulp.dest('../../master/release/theme_rtl/'))
});

gulp.task('rtlcss', function () {

  gulp
    .src(['./assets/base/css/*.css', '!./assets/base/css/*-rtl.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./assets/base/css/')); 

  gulp
    .src(['./assets/base/css/themes/*.css', '!./assets/base/css/themes/*-rtl.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./assets/base/css/themes/')); 

  /*
  gulp
    .src(['./assets/plugins/revo-slider/css/*.css', '!./assets/plugins/revo-slider/css/*-rtl.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./assets/plugins/revo-slider/css')); 
  */
});