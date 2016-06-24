<?php
/*
 * Scra框架入口文件
 */
      
if (PHP_VERSION < 5.4){
	echo '您的PHP版本过低，请使用5.4以上版本';
	die();
}else{
	//定义应用路径
	define('APP_PATH', 'application/');
	
	//定义系统路径
	define('SYS_PATH', 'system/');
	
	//加载默认配置文件，和上方的路径信息不能颠倒
	require_once APP_PATH.'config/config.php';
	
	//加载路由文件
	require_once SYS_PATH.'core/Route.php';

	$route = new Route;
	
	$method = $route->get_route();
	
	//获取控制器名称
	$controller = !empty($method[1]) ? $method[1] : DEFAULT_CONTROLLER;
	
	//获取方法名称
	$action = !empty($method[2]) ? $method[2] : DEFAULT_ACTION;
	
	//加载核心文件
	require_once SYS_PATH.'core/Scra.php';

	$scra = new Scra($controller,$action);

	$scra->index();
}