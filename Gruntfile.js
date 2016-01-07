'use strict';
/*Indica a grunt que es un archivo que contiene tareas a ejecutar*/
module.exports = function(grunt) {

	//Se inicia la configuración del projecto
		grunt.initConfig({
		//Le indica cuales archivos de configuracion se van a leer
		pkg: grunt.file.readJSON('nemo.jquery.json'),
		banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
			'<%= grunt.template.today("yyyy-mm-dd") %>\n' +
			'<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
			'* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
			' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
		// Inicio de la configuración de las tareas
		//Tarea que se utiliza para limpiar los archivos temporales que se crean al momento de minificar o combinar archivos
		clean: {
			files: ['dist']
		},
		//Concatena archivos css o js en un solo archivo
		concat: {
			options: {
				banner: '<%= banner %>',
				stripBanners: true
			},
			dist: {
				src: ['publication/js/libs/jquery.js', 'publication/js/libs/bootstrap.min.js', 'publication/js/libs/jquery.validate.js'],
				dest: 'publication/js/concat.<%= pkg.name %>.js'
			},
		},
		//Minifica archivos js
		uglify: {
			options: {
				banner: '<%= banner %>'
			},
			dist: {
				src: '<%= concat.dist.dest %>',
				dest: 'publication/js/libs.<%= pkg.name %>.min.js'
			},
		},
		//Se utiliza para revisar el código js
		qunit: {
			files: ['test/**/*.html','publication/js/*.js']
		},
		//Depura el código js
		jshint: {
			options: {
				jshintrc: true
			},
			gruntfile: {
				src: 'Gruntfile.js'
			},
			src: {
				src: ['publication/js/*.js','publication/**/*.js']
			},
			test: {
				src: ['test/**/*.js']
			},
			css: {
				src: ['publication/css/**/*.*','publication/css/*.*']
			},
		},
		stylus: {
			map:{
			  files: {
					'publication/css/style.css': 'src/stylus/main.styl'
				}
			},
			options:{
				 banner: '<%= banner %>', 
				compress: false,
				sourcemap:{
				           inline: true
				}
			},
			/*Tarea para compilar stylus, escuchamos solo el archivo base donde se importan todas las librerias*/
			compile: {
				files: {
					'publication/css/style.css': 'src/stylus/main.styl'
				}
			}
		},
		// Minifica y combina el código css
		cssmin: {
		      combine: {
		      files: {
		        'publication/css/<%= pkg.name %>.min.css': ['publication/css/*.*', "!publication/css/<%= pkg.name %>.min.css"]
		      }
		    }
		  },
		
		/*Cargamos Jade como template engine*/
		jade: {
			 compile: {
					 options: {
							 pretty: true,
							 data:{
							 	debug: true //Variable para compilar html con archivos de JS y CSS comprimidos si es false exporta cada archivo, si es true exporta con el link del archivo compilado 
							 }
					 },
					 files: [ {
						 cwd: "src/jTemplates", //Directorio donde se encuentran los archivos
						 src: [ '**/*.jade', '!**/partials/*.jade', '!**/modules/*.jade' ],//ignoramos las carpetas con los fragmentos de código
						 dest: "publication/templates/",
						 expand: true,//Esto  es para exportar el html comprimido o extendido
						 ext: ".html" //Extensión de los archivos
					 } ]
			 }
		},

		//Se usa para reiniciar automaticamente el navegador al momento de modificar algún archivo *leer reload.txt*
		browserSync: {
				dev: {
					bsFiles: {
                        src: [
                            'publication/**/*.php',
                            'publication/*.php',
                            'publication/css/*.css',
                            'publication/js/*.js',
                            'publication/templates/*.html',
                        ]
                    },
					options: {
						proxy: '127.0.0.1:8010', //our PHP server
						port: 8080, // our new port
						open: true,
						watchTask: true
					}
				}
			},
				//Se utiliza para ejecutar comandos de consola desde el archivo
		shell: {
			phantom: {
				command: 'phantomjs publication/js/phantom/screen.js',
				options: {
						stdout: true
				},
				init: {                      // Target
							options: {                      // Options
									stderr: false
							},
							command: 'git init'
					},

				stats: {                      // Target
							options: {                      // Options
									stderr: false
							},
							command: 'git status'
					},
					add: {                      // Target
							options: {                      // Options
									stderr: false
							},
							command: 'git add .'
					},
			},
            //Borra templates_c
            clearTemp:{
                    options: { // Options
                        stderr: false
                    },
                    command: 'rm publication/templates_c/*'
                }
	
	
		},
		//Crea el servidor PHP
		php: {
            dev: {
                options: {
                    port: 8010,
                    base: 'publication'
                }
            }
        },
		//Mantiene una tarea que observa los archivos y ejecuta tareas atumaticamente al momento de detectar cambios
		watch: {
			brm: {
				
				files: ['src/**/**.jade',
						'src/*.jade',
						'src/**/**.styl',
						'src/*.styl',
						'publication/*.js',
						'publication/**/**.js',
						'publication/images/**.*',
						'!publication/templates_c/*.*',
						'!publication/templates/*.*'
						],

				tasks : ["jade", "stylus", "cssmin","shell:clearTemp"],/*las tareas que se corren por defecto al observar cambios en los archivos*/
				task : ['shell:stats']
			}
		},
	});
// Fin de la configuración de las tareas

	// Se especifican los plugins que se van a utilizar
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-php');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-jade');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-shell');
	grunt.loadNpmTasks('grunt-browser-sync');
	grunt.loadNpmTasks('grunt-contrib-stylus');
	grunt.loadNpmTasks('grunt-stylus-map');

	// Se programan las tareas a ejecuar al momento de llamar "grunt %nombretarea%".
	grunt.registerTask('minicss', ['cssmin','clean']);
	grunt.registerTask('minificarjs', ['concat','uglify','clean']);
	grunt.registerTask('csstylus', ['stylus']);
	grunt.registerTask('template', ['jade']);
	grunt.registerTask('comando', ['shell:phantom']);
	grunt.registerTask('git', ['shell:init']);
	grunt.registerTask('stat', ['shell:stats','shell:add']);
	grunt.registerTask('observar', ['watch:brm','browserSync']);
	grunt.registerTask('depurar', ['jshint']);

    grunt.registerTask('default', ['php', 'browserSync:dev', 'watch:brm']);
	

};