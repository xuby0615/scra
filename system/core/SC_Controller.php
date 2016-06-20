<?php
class SC_Controller {
	
	function __construct(){
		DI::set('mail', Factory::mail());
		DI::set('smarty', Factory::smarty());
	}
	
	public function json($array){
		return json_encode($array);
	}
	
	public function mail(){
		return DI::get('mail');
	}
	
	public function smarty(){
		return DI::get('smarty');
	}
	
}

?>