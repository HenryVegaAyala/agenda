const mozjpeg = require('imagemin-pngquant')
module.exports = function (grunt) {
  grunt.initConfig({
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
    imagemin: {
      static: {
        options: {
          optimizationLevel: 7,
          svgoPlugins: [{removeViewBox: false}],
          use: [mozjpeg()]
        },
        files: {
          'web/images/excel_download.png': 'web/images/excel_download.png',
          'web/images/excel_import.png': 'web/images/excel_import.png',
          'web/images/usuario_hombre.png': 'web/images/usuario_hombre.png',
          'web/images/usuario_mujer.png': 'web/images/usuario_mujer.png'
        }
      },
      dynamic: {
        files: [{
          expand: true,
          cwd: 'web/images/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'web/images/'
        }]
      }
    },
    htmlmin: {
      dist: {
        options: {
          removeComments: true,
          collapseWhitespace: true
        },
        files: {
          'views/site/error.php': 'views/site/error.php',
          'views/site/index.php': 'views/site/index.php',
          'views/site/login.php': 'views/site/login.php',

          // 'views/layouts/activity.php': 'views/layouts/activity.php',
          'views/layouts/footer.php': 'views/layouts/footer.php',
          'views/layouts/header.php': 'views/layouts/header.php',
          'views/layouts/main.php': 'views/layouts/main.php',

          'views/user/create.php': 'views/user/create.php',
          'views/user/_form.php': 'views/user/_form.php',
        }
      },
    }
  }),

  grunt.loadNpmTasks('grunt-typescript'),
  grunt.loadNpmTasks('grunt-concat-sourcemap'),
  grunt.loadNpmTasks('grunt-contrib-watch'),
  grunt.loadNpmTasks('grunt-contrib-less'),
  grunt.loadNpmTasks('grunt-contrib-uglify'),
  grunt.loadNpmTasks('grunt-contrib-copy'),
  grunt.loadNpmTasks('grunt-contrib-sass'),
  grunt.loadNpmTasks('grunt-contrib-concat'),
  grunt.loadNpmTasks('grunt-contrib-imagemin'),
  grunt.loadNpmTasks('grunt-contrib-htmlmin'),

  grunt.registerTask('build', ['less', 'uglify', 'imagemin', 'htmlmin'])
}
