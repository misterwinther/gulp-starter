/*******************************************************************************
 1. FILE DESTINATIONS (RELATIVE TO ASSSETS FOLDER)
 *******************************************************************************/

var target = [];

/*** THEME_NAME ***/
target.push({
  name : 'THEME_NAME',
  path : 'webroot/_/',
  less : {
    // all less files to watch (all = 'less/**/*.less')
    watch : ['components/less/**/*.less', 'bower_components/**/*.less'],
    // all less files to compile
    src : ['components/less/master.less'],
    // where to put minified css
    css_dest : 'css',
  },
  js : {
    // all js files to watch (all = 'js/**/*.js')
    watch : ['components/js/**/*.js'],
    // all js that should be linted
    lint_src : ['components/js/master.js','components/js/ms-viewport-fix.js'],
    // all js files that should not be concatinated
    uglify_src : ['components/js/html5shiv.js','components/js/respond.js'],
    // all js files that should be concatinated

    concat_src : [
      'components/js/viewport-fix.js',
      'components/js/master.js'
    ],
    concat_file : 'master.min.js',

    // where to put compiled js
    dest : 'js'
  },
  livereload : {
  	watch : ['css/master.css', 'js/master.min.js'],
  },
});

target.push({
  name : 'php files',
  path : 'webroot/',
  
  livereload : {
  	watch : ['**/*.php'],
  },
});


/*******************************************************************************
 2. DEPENDENCIES
 *******************************************************************************/

// gulp core
var gulp = require('gulp'),
// less compiler
less = require('gulp-less'),
// uglifies the js
uglify = require('gulp-uglify'),
// check if js is ok
jshint = require('gulp-jshint'),
// rename files
rename = require("gulp-rename"),
// concatinate js
concat = require('gulp-concat'),
// send notifications to osx. NOTE: comment this out, when not on a MAC
notify = require('gulp-notify'),
// disable interuption
plumber = require('gulp-plumber'),
// make errors look good in shell
stylish = require('jshint-stylish'),
// minify the css files
minifycss = require('gulp-minify-css'),
// inject code to all devices
browserSync = require('browser-sync'), autoprefixer = require('gulp-autoprefixer'), gutil = require('gulp-util'), map = require('map-stream'),
// live reload on build
livereload = require('gulp-livereload');


/*******************************************************************************
 3. LESS TASK
 *******************************************************************************/

var default_less_task = function(obj) {
	var cur_file, error, startTime, process_time, endTime;

	if (obj.less.src && obj.less.src.length > 0) {
		startTime = process.hrtime();

		gutil.log(gutil.colors.magenta('Starting LESS'), gutil.colors.cyan('process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('...'));

		obj.less.src.forEach(function(src) {
			cur_file = obj.path + src;

			// get the files
			gulp.src(cur_file)

			// make sure gulp keeps running on errors
			.pipe(plumber({
				errorHandler : function(error) {
					var e = {
						title : "*** ERROR processing LESS ***",
						message : error.message.replace(/`/gi,'\'')
					};
					gutil.log(gutil.colors.red(e.title + "\n" + e.message), gutil.colors.cyan(' ')).beep();
					gulp.src(cur_file).pipe(notify(e));
					return this.end();
				}
			}))
			// compile all less
			.pipe(less())
			// complete css with correct vendor prefixes
			.pipe(autoprefixer('last 2 version', '> 1%', 'ie 8', 'ie 9', 'ios 6', 'android 4'))
			// minify css
			.pipe(minifycss())
			// where to put the file
			.pipe(gulp.dest(obj.path + obj.less.css_dest)); 
		});

		// notify when done
		if (!error) {
			gulp.src(cur_file).pipe(notify({
				title : 'LESS processed',
				message : 'LESS processed' + (obj.name ? ' for ' + obj.name : '') + ' in <%= options.process_time %>!',
				templateOptions : {
					process_time : function() {
						var endTime = process.hrtime(startTime);
						process_time = parseFloat((endTime[0] * 1000000 + endTime[1] / 1000) / 1000000);
						gutil.log(gutil.colors.cyan('Finished LESS process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('after'), gutil.colors.magenta(get_process_time_string(process_time)), gutil.colors.cyan(' '));
						return get_process_time_string(process_time);
					}()
				}
			}));
		}
		error = null;
	}
};

var less_process = function(obj) {
	/*
	 if (typeof obj.less.watch_task != 'undefined')
	 obj.less.watch_task(obj);
	 else
	 */
	default_less_task(obj);
};

var less_init = function(obj) {
	if (obj.less) {
		less_process(obj);
		// Set watch
		if (obj.less.watch && obj.less.watch.length > 0) {
			obj.less.watch.forEach(function(watch_file) {
				gulp.watch(obj.path + watch_file, function(event) {
					gutil.log(gutil.colors.cyan('Watch trigger \'' + event.type + '\':'), gutil.colors.magenta(event.path), gutil.colors.cyan(' '));
					less_process(obj);
				});
				gutil.log(gutil.colors.magenta('Initialized'), gutil.colors.cyan('watch for'), gutil.colors.magenta(obj.path + watch_file), gutil.colors.cyan(' '));
			});
		}
	}
};

/*******************************************************************************
 4. JS TASKS
 *******************************************************************************/

var default_js_task = function(obj) {
	var cur_file, error, startTime, process_time, endTime;

	// minify all js files that should not be concatinated
	if (obj.js.uglify_src && obj.js.uglify_src.length > 0) {
		startTime = process.hrtime();

		gutil.log(gutil.colors.magenta('Starting JS uglify'), gutil.colors.cyan('process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('...'));

		obj.js.uglify_src.forEach(function(src) {
			cur_file = obj.path + src;
			gulp.src(cur_file)
			.pipe(uglify())
			.on('error', function(error) {
				var e = {
					title : "*** ERROR in JS uglify ***",
					message : error.message.replace(/`/gi,'\'')
				};
				gutil.log(gutil.colors.red(e.title + "\n" + e.message), gutil.colors.cyan(' ')).beep();
				gulp.src(cur_file).pipe(notify(e));
				return this.end();
			})
			.pipe(rename(function(dir, base, ext) {
				var trunc = base.split('.')[0];
				return trunc + '.min' + ext;
			})).pipe(gulp.dest(obj.path + obj.js.dest));
		});

		if (!error) {
			gulp.src(cur_file).pipe(notify({
				title : 'JS uglified',
				message : 'JS uglified' + (obj.name ? ' for ' + obj.name : '') + ' in <%= options.process_time %>!',
				templateOptions : {
					process_time : function() {
						endTime = process.hrtime(startTime);
						process_time = parseFloat((endTime[0] * 1000000 + endTime[1] / 1000) / 1000000);
						gutil.log(gutil.colors.cyan('Finished JS uglify process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('after'), gutil.colors.magenta(get_process_time_string(process_time)), gutil.colors.cyan(' '));
						return get_process_time_string(process_time);
					}()
				}
			}));
		}
		error = null;
	}

	// lint my custom js
	if (obj.js.lint_src.length > 0) {
		startTime = process.hrtime();

		gutil.log(gutil.colors.magenta('Starting JS hint'), gutil.colors.cyan('process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('...'));

		obj.js.lint_src.forEach(function(src) {
			cur_file = obj.path + src;

			// get the files
			gulp.src(cur_file).pipe(jshint()).pipe(map(function(file, cb) {
				if (!file.jshint.success) {
					error = {
						title : "*** JSHINT warning ***",
						message : 'JSHINT warning in ' + file.path + ':'
					};
					file.jshint.results.forEach(function(result) {
						if (result.error) {
							//							console.log(result);
							error.message += "\n" + 'Line ' + result.error.line + ', char ' + result.error.character + ': ' + result.error.reason;
						}
					});
					gutil.log(gutil.colors.yellow(error.title + "\n" + error.message), gutil.colors.cyan(' ')).beep();
					gulp.src(file.path).pipe(notify(error));
				}
				cb(null, file);
			}));
		});

		if (!error) {
			gulp.src(cur_file).pipe(notify({
				title : 'JS linted',
				message : 'JS linted' + (obj.name ? ' for ' + obj.name : '') + ' in <%= options.process_time %>!',
				templateOptions : {
					process_time : function() {
						endTime = process.hrtime(startTime);
						process_time = parseFloat((endTime[0] * 1000000 + endTime[1] / 1000) / 1000000);
						gutil.log(gutil.colors.cyan('Finished JS hint process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('after'), gutil.colors.magenta(get_process_time_string(process_time)), gutil.colors.cyan(' '));
						return get_process_time_string(process_time);
					}()
				}
			}));
		}
		error = null;
	}

	// minify & concatinate all other js
	if (obj.js.concat_src.length > 0) {
		startTime = process.hrtime();

		gutil.log(gutil.colors.magenta('Starting JS concatinate'), gutil.colors.cyan('process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('...'));

		var concatinate_files = [];
		obj.js.concat_src.forEach(function(src) {
			concatinate_files.push(obj.path + src);
		});

		// get the files
		gulp.src(concatinate_files)
		// uglify the files
		.pipe(uglify())
		// concatinate to one file
		.pipe(concat(obj.js.concat_file))
		.on('error', function(error) {
			var e = {
				title : "*** ERROR in JS concatinate ***",
				message : error.message.replace(/`/gi,'\'')
			};
			gutil.log(gutil.colors.red(e.title + "\n" + e.message), gutil.colors.cyan(' ')).beep();
			gulp.src(less_src).pipe(notify(e));
			return this.end();
		})
		// where to put the files
		.pipe(gulp.dest(obj.path + obj.js.dest))
		// notify
		.pipe(notify({
			title : 'JS concatinated',
			message : 'JS concatinated' + (obj.name ? ' for ' + obj.name : '') + ' in <%= options.process_time %>!',
			templateOptions : {
				process_time : function() {
					endTime = process.hrtime(startTime);
					process_time = parseFloat((endTime[0] * 1000000 + endTime[1] / 1000) / 1000000);
					gutil.log(gutil.colors.cyan('Finished JS concatinate process for'), gutil.colors.cyan(obj.name), gutil.colors.cyan('after'), gutil.colors.magenta(get_process_time_string(process_time)), gutil.colors.cyan(' '));
					return get_process_time_string(process_time);
				}()
			}
		}));
	}
};

var js_process = function(obj) {
	/*
	 if (typeof obj.less.watch_task != 'undefined')
	 obj.less.watch_task(obj);
	 else
	 */
	default_js_task(obj);
};

var js_init = function(obj) {
	if (obj.js) {
		js_process(obj);
		// Set watch
		if (obj.js.watch) {
			obj.js.watch.forEach(function(watch_file) {
				gulp.watch(obj.path + watch_file, function(event) {
					gutil.log(gutil.colors.cyan('Watch trigger \'' + event.type + '\':'), gutil.colors.magenta(event.path), gutil.colors.cyan(' '));
					js_process(obj);
				});
				gutil.log(gutil.colors.magenta('Initialized'), gutil.colors.cyan('watch for'), gutil.colors.magenta(obj.path + watch_file), gutil.colors.cyan(' '));
			});
		}
	}
};


/*******************************************************************************
 5. LIVE RELOAD
 *******************************************************************************/

var default_livereload_task = function(cur_file) {
	gulp.src(cur_file).pipe(livereload());
};

var livereload_process = function(cur_file) {
	default_livereload_task(cur_file);
};

var livereload_init = function(obj) {
	if (obj.livereload) {

		if (obj.livereload.watch.length > 0) {
			
			obj.livereload.watch.forEach(function(src) {
				var cur_file = obj.path + src;
				// get the files
				livereload_process(cur_file);
			});
			
			// Set watch
			if (obj.livereload.watch) {
				obj.livereload.watch.forEach(function(watch_file) {
					// gulp.watch(obj.path + watch_file, function(event) {
					// 	gutil.log(gutil.colors.cyan('Watch trigger \'' + event.type + '\':'), gutil.colors.magenta(event.path), gutil.colors.cyan(' '));
					// 	livereload_process(obj.path + watch_file);
					// });
					// gutil.log(gutil.colors.magenta('Initialized'), gutil.colors.cyan('watch for'), gutil.colors.magenta(obj.path + watch_file), gutil.colors.cyan(' '));
					var server = livereload();
				    gulp.watch(obj.path + watch_file).on('change', function(file) {
				          gutil.log(gutil.colors.cyan('Watch trigger \'changed\':'), gutil.colors.magenta(file.path), gutil.colors.cyan(' '));
				          server.changed(file.path);
				      });
		            gutil.log(gutil.colors.magenta('Initialized'), gutil.colors.cyan('watch for'), gutil.colors.magenta(obj.path + watch_file), gutil.colors.cyan(' '));
				});
			}
		}
	}
};

/*******************************************************************************
 6. GULP TASKS
 *******************************************************************************/

var get_process_time_string = function(process_time) {
	var process_time_string = process_time.toFixed(2) + ' s';
	if (process_time * 1000000 < 1) {
		process_time_string = (process_time * 1000000).toFixed(6) + ' μs';
	} else if (process_time * 1000 < 1) {
		process_time_string = (process_time * 1000000).toFixed(2) + ' μs';
	} else if (process_time < 1) {
		process_time_string = (process_time * 1000).toFixed(2) + ' ms';
	}
	//	process_time_string += ' ('+process_time+')';
	return process_time_string;
};

gulp.task('init', function() {
	if (target.length < 1)
		return false;

	target.forEach(function(obj) {
		if (obj.less) {
			less_init(obj);
		}
		if (obj.js) {
			js_init(obj);
		}
		if (obj.livereload) {
			livereload_init(obj);
		}
	});
});

gulp.task('default', ['init']);