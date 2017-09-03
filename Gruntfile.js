module.exports = function (grunt) {
  grunt.initConfig({
    uglify: {
      dist: {
        src: 'web/js/agenda.js',
        dest: 'web/js/agenda.min.js'
      }
    }
  })

  grunt.loadNpmTasks('grunt-typescript');
  grunt.loadNpmTasks('grunt-concat-sourcemap');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.registerTask('build', ['less', 'typescript', 'copy', 'concat_sourcemap', 'uglify']);
  grunt.registerTask('default', ['watch']);
}
