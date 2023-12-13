const gulp = require("gulp");
const cssmin = require("gulp-cssmin");
const uglify = require("gulp-uglify-es").default;
const watch = require("gulp-watch");
const flatten = require("gulp-flatten");

const pathJs = "public/js/*.js";
const pathNoJs = "!public/js/_*.js";
const pathNoJs2 = "!public/js/* copy.js";
const pathCss = "public/css/*.css";
const pathComponentsCss = "App/Templates/*/*/*.css";
const pathComponentsJs = "App/Templates/*/*/*.js";
const pathComponentsAssets = "App/Templates/*/*/assets/*";
const pathNoCss = "!public/css/_*.css";
const pathIcons = "public/css/*.woff2";

const toMinJs = "public/minjs";
const toMinCss = "public/mincss";
const toMinComponentsCss = "public/mincss";
const toMinComponentsJs = "public/minjs";
const toMinComponentsAssets = "public/assets";

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
function minComponentsAssets() {
  return gulp
    .src([pathComponentsAssets])
    .pipe(flatten({ includeParents: 0 }))
    .pipe(gulp.dest(toMinComponentsAssets));
}

gulp.task("minjs", minjs);
gulp.task("mincss", mincss);
gulp.task("minComponentsCss", minComponentsCss);
gulp.task("minComponentsJs", minComponentsJs);
gulp.task("minComponentsAssets", minComponentsAssets);

gulp.task("watch", function () {
  gulp.watch(pathJs, gulp.parallel("minjs"));
  gulp.watch(pathCss, gulp.parallel("mincss"));
  gulp.watch(pathComponentsCss, gulp.parallel("minComponentsCss"));
  gulp.watch(pathComponentsJs, gulp.parallel("minComponentsJs"));
  gulp.watch(pathComponentsAssets, gulp.parallel("minComponentsAssets"));
});
