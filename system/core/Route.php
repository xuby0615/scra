<?php
class Route{
	
	private $_route;
	
	function __construct($route){
		$this->_route = $route;
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
					$_GET[$b[0]] = $b[1];
				}
			}
			return explode('/', $route[0]);
		}else {
			return false;
		}
	}
}