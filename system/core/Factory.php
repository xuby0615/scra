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
		return new $controller();
	}
	
	//实例化模型
	public static function model($model){
		return new $model();
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
	
	//实例化验证码类
	public static function captcha($config){
		return new Captcha($config);
	}
	
	//实例化上传类
	public static function upload($config){
		return new Upload($config);
	} 
	
	//实例化smarty类
	public static function smarty(){
		include APP_PATH.'config/smarty.php';
		$smarty = new Smarty();
		
		$smarty->setTemplateDir($smarty_config['template_dir']);
		$smarty->compile_dir = $smarty_config['compile_dir'];
		$smarty->cache_dir = $smarty_config['cache_dir'];
		$smarty->caching = $smarty_config['caching'];
		$smarty->left_delimiter = $smarty_config['left_delimiter'];
		$smarty->right_delimiter = $smarty_config['right_delimiter'];
		$smarty->compile_check  = $smarty_config['compile_check'];
		$smarty->debugging = $smarty_config['debugging'];
		
		return $smarty;
	}

}