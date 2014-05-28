var path = '/Applications/MAMP/htdocs/oficinadamadeira';module.exports = function( grunt ) {   grunt.initConfig({  	pkg: grunt.file.readJSON('package.json'),  	uglify: {  		options: {   			// the banner is inserted at the top of the output    		banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'  		},  		  		dist: {    		files: {      			'js/scripts.js': ['js/caroussel.js','js/wow.js','bower_components/foundation/js/foundation.min.js','js/app.js'],    		}  		}	  },    sprite:{      'all': {        src: 'sprites/*.png',        destImg: 'images/spritesheet.png',        destCSS: 'sprites.css',        algorithm: 'binary-tree'      }    },  cssmin: {    add_banner: {      options: {        banner: '/*\nTheme Name: <%= pkg.title %>\nTheme URI: <%= pkg.homepage %>\nDescription: <%= pkg.description %>\nVersion: <%= pkg.version %>\nAuthor: <%= pkg.author %>\nTags: <%= pkg.tags %>\n*/'      },          files: {        'style.css': ['stylesheets/app.css','sprites.css','stylesheets/jpreloader.css','stylesheets/animate.css']      }    }  },  imagemin: {            dist: {                options: {                    optimizationLevel: 7,                    progressive: true                },                files: [{                    expand: true,                    cwd: 'images/',                    src: '**/*',                    dest: 'images/'                }]            }  },	watch : {      dist : {        files : [          'js/*','stylesheets/*','images/*','*.php','*.html','sprites/*'        ],         tasks : [ 'uglify','sprite','cssmin' ]      }    },    'ftp-deploy': {      build: {        auth: {        host: 'ftp.officinadamadeira.com.br',        port: 21,        authKey: 'key1'      },        src: path,        dest: '/public_html/wp-content/themes/officinadamadeira/',        exclusions: [          path+'/node_modules/*',          path+'/node_modules',          path+'/bower_components/*',          path+'/bower_components',          path+'/sprites/*',          path+'/sprites',          path+'/scss/*',          path+'/scss',          path+'/stylesheets/*',          path+'/stylesheets',          path+'/media/*',          path+'/media',          path+'/.sass-cache/*',          path+'/.sass-cache',          path+'/Gruntfile.js',          path+'/bower.json',          path+'/README.md',          path+'/.gitignore',          path+'/.ftppass',          path+'/.bowerrc',          path+'/.DS_Store',          path+'/package.json',          path+'/.git/*',          path+'/.git',          path+'/fonts/*',          path+'/images/*',          path+'/functions'        ]      }    }  });    grunt.loadNpmTasks('grunt-ftp-deploy');  grunt.loadNpmTasks('grunt-contrib-uglify');  grunt.loadNpmTasks('grunt-contrib-cssmin');  grunt.loadNpmTasks('grunt-spritesmith');  grunt.loadNpmTasks('grunt-contrib-watch');  //grunt.loadNpmTasks("grunt-rsync");  grunt.loadNpmTasks('grunt-contrib-imagemin');  grunt.registerTask( 'default', ['ftp-deploy'] );  grunt.registerTask( 'w', [ 'watch' ] );};