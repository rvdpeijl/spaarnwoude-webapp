var gulp        = require('gulp'),
    sass        = require('gulp-ruby-sass')
	sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function() {
    return sass('styles/sass/', { sourcemap: true })
    .on('error', function (err) {
      console.error('Error', err.message);
   })

    .pipe(sourcemaps.write('maps', {
        includeContent: false,
        sourceRoot: 'sass'
    }))

    .pipe(gulp.dest('styles/css'));
});

gulp.task('watch', function() {
    gulp.watch(['styles/sass/main.scss',
    'styles/sass/**/*.scss'], ['sass']);
});

gulp.task('default', ['sass', 'watch']);