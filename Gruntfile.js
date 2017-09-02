module.exports = function (grunt) {
  grunt.initConfig({
    uglify: {
      dist: {
        src: '/js/agenda.js',
        dest: '/web/dis/agenda.min.js'
      }
    }
  })

  grunt.loadNpmTasks('grunt-contrib-uglify')
}
