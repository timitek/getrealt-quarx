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
      './resources/assets/js/vendor/polly.js',

      './resources/assets/js/vendor/quarx/forms.js',
      './resources/assets/js/vendor/quarx/typeahead.bundle.js',
      './resources/assets/js/vendor/quarx/bootstrap-tagsinput.min.js',
      './resources/assets/js/vendor/quarx/sortable.min.js',

      './resources/assets/js/vendor/quarx/packages/dropzone/dropzone.js',
      
      './resources/assets/js/vendor/quarx/packages/datepicker/moment.js',
      './resources/assets/js/vendor/quarx/packages/datepicker/moment-timezone.js',
      './resources/assets/js/vendor/quarx/packages/datepicker/bootstrap-datetimepicker.min.js',
    
      './resources/assets/js/vendor/quarx/packages/redactor/redactor.js',
      './resources/assets/js/vendor/quarx/packages/redactor/filemanager.js',
      './resources/assets/js/vendor/quarx/packages/redactor/fontcolor.js',
      './resources/assets/js/vendor/quarx/packages/redactor/fontfamily.js',
      './resources/assets/js/vendor/quarx/packages/redactor/fontsize.js',
      './resources/assets/js/vendor/quarx/packages/redactor/imagemanager.js',
      './resources/assets/js/vendor/quarx/packages/redactor/stockimagemanager.js',
      './resources/assets/js/vendor/quarx/packages/redactor/specialchar.js',
      './resources/assets/js/vendor/quarx/packages/redactor/table.js',
      './resources/assets/js/vendor/quarx/packages/redactor/video.js',
      './resources/assets/js/vendor/quarx/packages/redactor/insertIcon.js'

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
