<?php
require_once SYS_PATH.'core/Autoload.php';

class Scra{
	private $_di;
	private $_action;
	private $_controller;

	function __construct($controller,$action){
		$this->_di = Factory::DI();
		$this->_action = $action;
		$this->_controller = $controller;
		Di::set('controller',Factory::controller($this->_controller));
	}

	public function index(){
		$action = $this->_action;
		$con = $this->_di->get('controller');
		$methods = get_class_methods($con);

		if (in_array($action, $methods)){
			$con->$action();
		}else{
			$this->miss_method($action);
			die();
		}
	}
	
	public function miss_method($action){
		echo '<h2>Error: This action: '.$action.'() doesn\'t exist.</h2>';
	}

}

?>