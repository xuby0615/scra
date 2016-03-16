<?php

/*
 * Const Config
 */

/*
 * Base Url
 * When you want to use js/css/image/uploadfile path,you must to config this path
 * 
 */
define('BASE_URL', './');

/*
 * MVC Default Path
 */
define('C', APP_PATH.'controller/');
define('M', APP_PATH.'model/');
define('V', APP_PATH.'view/');

/*
 * JS Path
 * Including Dev's JavaScript File or CDN source
 */
define('JS_PATH', BASE_URL.'statics/javascript/');
define('jQuery_PATH', 'http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js');
define('Angular_PATH', 'http://apps.bdimg.com/libs/angular.js/1.4.6/angular.min.js');
define('Bootstrap_JS_PATH', 'http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js');

/*
 * CSS Path
 * Including Dev's CSS File or CDN source
 */
define('CSS_PATH', BASE_URL.'statics/css/');
define('Bootstrap_CSS_PATH','http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css');

/*
 * Image Path
 */
define('IMG_PATH', BASE_URL.'statics/image/');

/*
 * Uploadfile Path
 */
define('UPLOAD_PATH', BASE_URL.'statics/uploadfile/');

/*
 * Init Config
 * Including Default Controller and Action
 */
define('DEFAULT_CONTROLLER', 'Index');
define('DEFAULT_ACTION', 'home');