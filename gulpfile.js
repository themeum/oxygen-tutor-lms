var gulp = require("gulp"),
	sass = require("gulp-sass"),
	rename = require("gulp-rename"),
	prefix = require("gulp-autoprefixer"),
	plumber = require("gulp-plumber"),
	notify = require("gulp-notify"),
	wpPot = require('gulp-wp-pot'),
	clean = require("gulp-clean"),
	zip = require("gulp-zip"),
	fs = require('fs'),
	path = require('path');

var onError = function (err) {
	notify.onError({
		title: "Gulp",
		subtitle: "Failure!",
		message: "Error: <%= error.message %>",
		sound: "Basso",
	})(err);
	this.emit("end");
};



gulp.task('makepot', function () {
	return gulp
		.src('**/*.php')
		.pipe(plumber({
			errorHandler: onError
		}))
		.pipe(wpPot({
			domain: 'tutor',
			package: 'Tutor LMS'
		}))
		.pipe(gulp.dest('languages/oxygen-tutor-lms.pot'));
});

/**
 * Build
 */
gulp.task("clean-zip", function () {
	return gulp.src("./oxygen-tutor-lms.zip", {
		read: false,
		allowEmpty: true
	}).pipe(clean());
});

gulp.task("clean-build", function () {
	return gulp.src("./build", {
		read: false,
		allowEmpty: true
	}).pipe(clean());
});

gulp.task("copy", function () {
	return gulp
		.src([
			"./**/*.*",
			"!./build/**",
			"!./assets/**/*.map",
			"!./assets/scss/**",
			"!./assets/.sass-cache",
			"!./node_modules/**",
			"!./**/*.zip",
			"!.github",
			"!./gulpfile.js",
			"!./readme.md",
			"!./README.md",
			"!.DS_Store",
			"!./**/.DS_Store",
			"!./LICENSE.txt",
			"!./package.json",
			"!./package-lock.json",
		])
		.pipe(gulp.dest("build/"));
});

gulp.task("make-zip", function () {
	return gulp.src("./build/**/*.*").pipe(zip(`oxygen-tutor-lms.zip`)).pipe(gulp.dest("./"));
});

/**
 * Export tasks
 */
exports.build = gulp.series(
	"clean-zip",
	"clean-build",
	"makepot",
	"copy",
	"make-zip"
);
