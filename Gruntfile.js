module.exports = function (grunt) {
  grunt.initConfig({
    // uglify: {
    //   options: {
    //     compress: true,
    //     separator: ';'
    //   },
    //   dist: {
    //     src: ['web/js/agenda.js', 'web/js/custom.js'],
    //     dest: 'web/js/ticket.js'
    //   }
    // },
    uglify: {
      options: {
        compress: true,
        separator: ';'
      },
      dist: {
        src: 'web/js/agenda.js',
        dest: 'web/js/agenda.min.js'
      }
    },
    less: {
      options: {
        compress: true,
        style: 'expanded'
      },
      dist: {
        src: 'web/css/custom.css',
        dest: 'web/css/custom.scss'
      }
    },
  }),

    grunt.loadNpmTasks('grunt-typescript'),
    grunt.loadNpmTasks('grunt-concat-sourcemap'),
    grunt.loadNpmTasks('grunt-contrib-watch'),
    grunt.loadNpmTasks('grunt-contrib-less'),
    grunt.loadNpmTasks('grunt-contrib-uglify'),
    grunt.loadNpmTasks('grunt-contrib-copy'),
    grunt.loadNpmTasks('grunt-contrib-sass'),
    grunt.loadNpmTasks('grunt-contrib-concat'),

    grunt.registerTask('build', ['less', 'uglify'])
}
