var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');


gulp.task('js', function() {
    gulp.src('./resources/assets/js/*.js')
      .pipe(uglify())
      .pipe(gulp.dest('./resources/assets/themes/getrealt/js'));
});

gulp.task('sass', function () {
  return gulp.src('./resources/assets/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./resources/assets/themes/getrealt/css'));
});

gulp.task('default', ['js', 'sass']);
