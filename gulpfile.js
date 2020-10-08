var gulp = require('gulp'),
  connect = require('gulp-connect-php'),
  browserSync = require('browser-sync');

var PORT = 8000 + Math.floor(Math.random() * Math.floor(1000));

gulp.task('watch', function() {
  connect.server({
    base: 'HTML',
    port: PORT,
  }, function (){
   browserSync({
     proxy: '127.0.0.1:' + PORT,
     snippetOptions: {
      rule: {
        match: /<\/body>/i,
        fn: function (snippet, match) {
          return snippet + match;
        }
      },
     }
   });
 });

  gulp.watch(['**/*.php', '!data/*', 'src/**/*', 'images/*', '**/src/**/*']).on('change', function () {
    console.log('Listening to  http://localhost:' + PORT);
    browserSync.reload();
  });
});

gulp.task('default', gulp.parallel('watch'));
