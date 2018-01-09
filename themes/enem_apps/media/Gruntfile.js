/** Enem Apps Variable **/
var enemAppsBasePath = 'enem_apps/',
    enemAppsScssPath = enemAppsBasePath + 'master_enem',
    enemAppsJsPath   = enemAppsBasePath + 'enem_js/';
/************************/

module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
//      options: {
//        includePaths: [foundationScssPath, bootstrapScssPath]
//      },
      dist: {
        options: {
          outputStyle: 'compressed',
          report: 'gzip',
        },
        files: {
          'css/app.min.css': 'enem_apps/master_enem/master_enem.scss'
        }
      },
      dev: {
        options: {
          outputStyle: 'nested',
          report: 'gzip',
        },
        files: {
          'css/app.css': 'enem_apps/master_enem/master_enem.scss'
        }
      }
    },
      
    cssmin: {
        options: {
            report: 'min',
        },
        target: {
//            files: [{
//                expand: true,
//                cwd: 'css/',
//                src: ['*.css', '!*.min.css'],
//                dest: 'css/',
//                ext: '.min.css'
//            }]
            files: {
                'css/app.min.css': ['css/app.min.css']
            }
        }
    },

    concat: {
//      options: {
//        separator: ';',
//        banner: '\n',
//      },
      vendor: {
        src: [
          'bower_components/jquery/dist/jquery.js',
          'bower_components/modernizr/modernizr.js',
//          foundationJsPrefix + 'js',
//          foundationJsPrefix + 'abide.js',
//          foundationJsPrefix + 'accordion.js',
//          foundationJsPrefix + 'aleart.js',
//          foundationJsPrefix + 'clearing.js',
//          foundationJsPrefix + 'dropdown.js',
//          foundationJsPrefix + 'equalizer.js',
//          foundationJsPrefix + 'interchange.js',
          // foundationJsPrefix + 'joyride.js',
          // foundationJsPrefix + 'magellan.js',
//          foundationJsPrefix + 'offcanvas.js',
//          foundationJsPrefix + 'orbit.js',
//          foundationJsPrefix + 'reveal.js',
          // foundationJsPrefix + 'slider.js',
//          foundationJsPrefix + 'tab.js',
//          foundationJsPrefix + 'tooltip.js',
//          foundationJsPrefix + 'topbar.js',
            
          // for bootstrap js
//          bootstrapJsPath + 'bootstrap.min.js',
        
          // Enem Plugin Slider
//          'bower_components/swiper/dist/js/swiper.min.js',
            
          //Enem Required Plugin Animate Wave
          'bower_components/waves/dist/waves.min.js',
            
          //Enem Required Plugin Chart
//          'bower_components/raphael/raphael-min.js',
//          'bower_components/morris.js/morris.min.js',

            
          // for enem_apps js 
          enemAppsJsPath + 'TweenMax.min.js',
          enemAppsJsPath + 'ScrollToPlugin.min.js',
          enemAppsJsPath + 'enem.js',
            
        //Flat Lab required plugin
            'js/bootstrap.min.js',
            'js/jquery.dcjqaccordion.2.7.js',
            'js/jquery.scrollTo.min.js',
            'js/jquery.nicescroll.js',
            'js/jquery.sparkline.js',
            'assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js',
            'js/owl.carousel.js',
            'js/jquery.customSelect.min.js',
            'js/respond.min.js',
            'js/common-scripts.js',
            'js/sparkline-chart.js',
            'js/easy-pie-chart.js',
//            'js/count.js',
            'assets/advanced-datatable/media/js/jquery.dataTables.js'


          // required plugin
//          'js/carousel/carouFredSel.js',
//          'js/paralax-slide/responsive-slider.js',
//          'js/scrolltofixed/jquery-scrolltofixed.js',
//          'js/page-navigation/jquery.malihu.PageScroll2id.min.js',
//          'js/fancybox/jquery.fancybox.js',
//          'js/crop/imgLiquid-min.js',
//          'js/waitForImages/jquery.waitforimages.min.js',
          // 'js/jssor-slider/jssor.slider.mini.js',
          // 'js/jssor-slider/jssor.js',
//          'js/fancybox/jquery.fancybox-thumbs.js',
          //my script
          //'js/app.js',
          // 'js/unduh.js',
          // 'js/publikasi.js',
          // 'js/faq.js',
          // 'js/produk.js',         
        ],
          // foundationJsPrefix + 'topbar.js',
        dest: 'js/app.js'
      }
    },

    uglify: {
      options: {
        mangle: true,
        compress: true,
        report: 'gzip'        
      },
      target: {
        files: {
          'js/app.min.js':['js/app.js']
        }
      }
    },

    // removelogging: {
    //   js: {
    //     src: "js/app.min.js",
    //     dest: "js/app.min.js"
    //   }
    // },

    watch: {
      grunt: {
        files: ['Gruntfile.js'],
        tasks: ['development-task']
      },
      sass: {
        files: 'enem_apps/**/*.scss',
        tasks: ['development-task']
      },
      js: {
        files: 'js/**/*.js',
        tasks: ['development-task']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-csslint');

  grunt.registerTask('development-task', ['sass:dev','concat:vendor']);
  grunt.registerTask('production-task', ['sass:dist','uglify']);
  grunt.registerTask('production-min-task',['sass:dist','uglify','cssmin:target','cssmin:target','cssmin:target','cssmin:target','cssmin:target','cssmin:target','cssmin:target','cssmin:target']);

  grunt.registerTask('build', ['production-task']);
  grunt.registerTask('build-min', ['production-min-task']);
  grunt.registerTask('default', ['development-task','watch']);
    
  grunt.registerTask('enem',['build','default']);
  grunt.registerTask('enem-extream',['build-min','default']);
}