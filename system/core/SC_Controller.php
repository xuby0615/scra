<?php
class SC_Controller {
	
	function __construct(){
		require_once 'SC_Function.php';
		DI::set('mail', Factory::mail());
		DI::set('smarty', Factory::smarty());
	}
	
	//返回json格式的数据
	public function json($array){
		return json_encode($array);
	}

	//解决Ajax跨域问题
	public function ajax_cron(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		if('OPTIONS' != $_SERVER['REQUEST_METHOD']) return;
		header('Access-Control-Allow-Headers: Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
		header('Access-Control-Max-Age: ' . 3600 * 24);
	}
	
	//邮件配置
	public function mail(){
		return DI::get('mail');
	}
	
	//smarty模板
	public function smarty(){
		return DI::get('smarty');
	}
	
}

?>