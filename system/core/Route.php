<?php
class Route{
	private $_route;
	
	function __construct($route){
		$this->_route = str_replace('index.php','',addslashes(trim($route)));
	}
	
	public function get_route(){
		$route = (strstr($this->_route,'?')) ? explode('?', $this->_route) : array($this->_route);
		if (count($route) == 2){
			$param = explode('&', $route[1]);
			foreach ($param as $a){
				$b = explode('=', $a);
				$_GET[$b[0]] = $this->kill_sql_keywords($b[1]);
			}
		}
		return explode('/', $route[0]);
	}

}