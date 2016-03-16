<?php
class Route{
	
	private $_route;
	
	function __construct($route){
		$this->_route = $route;
	}
	
	private function vali_route(){
		if ($this->_route == '/'){
			return false;
		}else {
			return true;
		}
	}
	
	public function get_route(){
		if ($this->vali_route()){
			$this->_route = str_replace('/index.php', '', $this->_route);
			return explode('/', $this->_route);
		}else {
			return false;
		}
	}
}