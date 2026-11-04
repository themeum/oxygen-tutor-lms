var gulp = require("gulp"),
	clean = require("gulp-clean"),
	zip = require("gulp-zip");


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
		.pipe(gulp.dest("build/oxygen-tutor-lms"));
});

gulp.task("make-zip", function () {
	const package = require('./package.json');
	return gulp.src("./build/**/*.*").pipe(zip(`oxygen-tutor-lms-${package.version}.zip`)).pipe(gulp.dest("./"));
});

/**
 * Export tasks
 */
exports.build = gulp.series(
	"clean-zip",
	"clean-build",
	"copy",
	"make-zip"
);
