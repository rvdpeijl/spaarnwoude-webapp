var gulp        = require('gulp'),
    sass        = require('gulp-ruby-sass');

gulp.task('styles', function() {
    return gulp.src('styles/sass/main.scss')
    .pipe(sass({ style: 'expanded', }))
    .pipe(gulp.dest('styles/css'));
});

gulp.task('watch', function() {
    gulp.watch(['styles/sass/main.scss',
    'styles/sass/**/*.scss'], ['styles']);
});

gulp.task('default', ['styles', 'watch']);