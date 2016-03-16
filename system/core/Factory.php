<?php
/*
 * 工厂类
 */
class Factory{

	//实例化IoC容器
	public static function DI(){
		return new Di();
	}
	
	//实例化URL传递的控制器
	public static function controller($controller){
		return new $controller;
	}
	
	//实例化模型
	public static function model($model){
		return new $model;
	} 

	//实例化DB类
	public static function mysql_conn(){
		include APP_PATH.'config/database.php';
		return new Mysql($config);
	}
	
	//实例化分页类
	public static function pagination($page_size){
		return new Pagination($page_size);
	}
	
	//实例化邮件类
	public static function mail(){
		return new PHPMailer();
	}

}