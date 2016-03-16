<?php
class Controller {
	
	protected $_di;
	
	function __construct(){
		$this->_di = Factory::DI();
		DI::set('mail', Factory::mail());
	}
	
	public function json($array){
		return json_encode($array);
	}
	
	public function mail(){
		return DI::get('mail');
	}
	
}

?>