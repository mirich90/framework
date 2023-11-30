const gulp = require("gulp");
const cssmin = require("gulp-cssmin");
const uglify = require("gulp-uglify-es").default;
const watch = require("gulp-watch");

const pathJs = "public/js/*.js";
const pathNoJs = "!public/js/_*.js";
const pathNoJs2 = "!public/js/* copy.js";
const pathCss = "public/css/*.css";
const pathComponentsCss = "App/Templates/*/*/*.css";
const pathComponentsJs = "App/Templates/*/*/*.js";
const pathNoCss = "!public/css/_*.css";
const pathIcons = "public/css/*.woff2";

const toMinJs = "public/minjs";
const toMinCss = "public/mincss";
const toMinComponentsCss = "public/mincss";
const toMinComponentsJs = "public/minjs";

function minjs() {
  return (
    gulp
      .src([pathJs, pathNoJs, pathNoJs2])
      // .pipe(uglify({ toplevel: false }))
      .pipe(gulp.dest(toMinJs))
  );
}
function mincss() {
  return gulp
    .src([pathCss, pathNoCss, pathIcons])
    .pipe(cssmin())
    .pipe(gulp.dest(toMinCss));
}
function minComponentsCss() {
  return gulp
    .src([pathComponentsCss])
    .pipe(cssmin())
    .pipe(gulp.dest(toMinComponentsCss));
}
function minComponentsJs() {
  return gulp
    .src([pathComponentsJs])
    .pipe(cssmin())
    .pipe(gulp.dest(toMinComponentsJs));
}

gulp.task("minjs", minjs);
gulp.task("mincss", mincss);
gulp.task("minComponentsCss", minComponentsCss);
gulp.task("minComponentsJs", minComponentsJs);

gulp.task("watch", function () {
  gulp.watch(pathJs, gulp.parallel("minjs"));
  gulp.watch(pathCss, gulp.parallel("mincss"));
  gulp.watch(pathComponentsCss, gulp.parallel("minComponentsCss"));
  gulp.watch(pathComponentsJs, gulp.parallel("minComponentsJs"));
});
