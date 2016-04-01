<?php
class Route{
	
	private $_route;
	
	//sql关键字
	private static $str_sql = array('>','<','=','!','+','-','*','/','"','\'',' ','_','%','.',',',';','(',')','\\','0x','group','order','by',
									'desc','asc','limit','count','select','update','delete','insert','create','drop','table','database','and',
									'or','when','case','else','then','where','from','in','like','information','schema','mysql','charset',
									'characterset','len','end');
	
	function __construct($route){
		$this->_route = $route;
	}
	
	private function kill_sql_keywords($string){
		foreach (self::$str_sql as $keywords) {
			$string = str_replace($keywords, '', strtolower($string));
		}
		return $string;
	}
	
	private function vali_route(){
		$this->_route = str_replace('/index.php', '/', $this->_route);
		if ($this->_route == '/'){
			return false;
		}else {
			return true;
		}
	}
	
	public function get_route(){
		if ($this->vali_route()){
			$route = (strstr($this->_route,'?')) ? explode('?', $this->_route) : array($this->_route);
			if (count($route) == 2){
				$param = explode('&', $route[1]);
				foreach ($param as $a){
					$b = explode('=', $a);
					$_GET[$b[0]] = $this->kill_sql_keywords($b[1]);
				}
			}
			return explode('/', $route[0]);
		}else {
			return false;
		}
	}
}