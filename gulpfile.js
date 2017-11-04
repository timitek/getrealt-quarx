var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('js', function() {
    // Pace
    gulp.src([
      './resources/assets/js/vendor/pace.min.js'
    ])
    .pipe(gulp.dest('./resources/assets/themes/getrealt/js'));
    
    // Vendor
    gulp.src([
      './resources/assets/js/vendor/parallax.js',
      './resources/assets/js/vendor/polly.js'
    ])
    .pipe(sourcemaps.init())
    .pipe(concat('vendor.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./resources/assets/themes/getrealt/js'));
    
    // Quarx / Admin
    gulp.src([
      './resources/assets/js/getrealt-admin.js'
    ])
    .pipe(sourcemaps.init())
    .pipe(concat('getrealt-admin.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./resources/assets/themes/getrealt/js'));
    
    // Theme / Front-end
    gulp.src([
      './resources/assets/js/rest.js',
      './resources/assets/js/getrealt-frontend.js'
    ])
    .pipe(sourcemaps.init())
    .pipe(concat('getrealt-frontend.min.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./resources/assets/themes/getrealt/js'));
});

gulp.task('sass', function () {
  return gulp.src('./resources/assets/sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./resources/assets/themes/getrealt/css'));
});

gulp.task('default', ['js', 'sass']);
