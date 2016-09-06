<?php
/*
 * 路由文件
 */
class Route{
	
	private $_route;
	private static $match_uri = '/^(\/index\.php|\/|\/[a-zA-Z_]+\/[a-zA-Z_]+|\/[a-zA-Z_]+\/[a-zA-Z_]+\?.+)$/';
	
	function __construct(){
		$param = addslashes(trim($_SERVER['REQUEST_URI']));
		if(preg_match(self::$match_uri,$param)){
			$this->_route = addslashes(trim($param));
		}else {
			echo '<h2>500，错误的访问路径<h3>'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'</h3></h2>';
			exit(); 
		}
	}
	
	public function get_route(){
		$route = (strstr($this->_route,'?')) ? explode('?', $this->_route) : array($this->_route);
		unset($_GET);
		if (count($route) == 2){
			$param = explode('&', $route[1]);
			foreach ($param as $a){
				$b = explode('=', $a);
				$_GET[$b[0]] = $b[1];
			}
		}else{
			if (count(explode('/',$route[0]))!=3){
				$route[0] = '/'.DEFAULT_CONTROLLER.'/'.DEFAULT_ACTION;
			}
		}
		return explode('/', $route[0]);
	}

}