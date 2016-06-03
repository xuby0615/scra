<?php

/*
 * Const Configuration File
 * Scra will use this file's var to config all framework!!
 * Also,you can add some const vars in order to use in your own function
 * We have provider jQuery/AngularJS/Bootstrap/FontAwesome
 */

/*
 * Base Url
 * When you want to use js/css/image/uploadfile path,you must to config this path
 */
define('BASE_URL', '/');

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
define('UPLOAD_JS', BASE_URL.'statics/javascript/AjaxUploadFile.js');
define('jQuery', 'http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js');
define('AngularJS', 'http://apps.bdimg.com/libs/angular.js/1.4.6/angular.min.js');
define('Bootstrap_JS', 'http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js');

/*
 * CSS Path
 * Including Dev's CSS File or CDN source
 */
define('CSS_PATH', BASE_URL.'statics/css/');
define('Bootstrap_CSS','http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css');
define('FA_CSS','http://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css');

/*
 * Font Path
*/
define('Font_PATH', BASE_URL.'statics/font/');

/*
 * Image Path
 */
define('IMG_PATH', BASE_URL.'statics/image/');

/*
 * Uploadfile Path
 */
define('UPLOAD_PATH', 'statics/uploadfile/'.date("Ymd",time()).'/');

/*
 * Init Config
 * Including Default Controller and Action
 */
define('DEFAULT_CONTROLLER', 'Index');
define('DEFAULT_ACTION', 'home');