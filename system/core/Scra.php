<?php
require_once SYS_PATH.'core/Autoload.php';

class Scra{
	private $_di;
	private $_action;

	function __construct($controller,$action){
		$this->_di = Factory::DI();
		$this->_action = $action;
		Di::set('controller',Factory::controller($controller));
	}

	public function index(){
		$action = $this->_action;
		$con = $this->_di->get('controller');
		$methods = get_class_methods($con);
		if (in_array($action, $methods)){
			$con->$action();
		}else{
			$this->miss_method();
			die();
		}
	}
	
	public function miss_method(){
		echo 'No Action Selected';
	}

}

?>