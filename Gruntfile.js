module.exports = function (grunt) {
  grunt.initConfig({
    uglify: {
      options: {
        compress: true
      },
      dist: {
        src: 'web/js/agenda.js',
        dest: 'web/js/agenda.min.js'
      }
    },
    less: {
      options: {
        compress: true
      },
      dist: {
        src: 'web/css/custom.css',
        dest: 'web/css/custom.less'
      }
    },
    watch: {
      less: {
        files: ['web/css/*.less'],
        tasks: ['less'],
        options: {
          livereload: true
        }
      },
    }

  })

  grunt.loadNpmTasks('grunt-typescript')
  grunt.loadNpmTasks('grunt-concat-sourcemap')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-less')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-copy')

  grunt.registerTask('build', ['less', 'uglify'])
  grunt.registerTask('default', ['watch'])
}
