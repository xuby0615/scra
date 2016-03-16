<?php
class Model {
	private $_di;
	
	function __construct(){
		DI::set('mysql', Factory::mysql_conn());
		$this->_di=Factory::DI();
	}
	
	public function get_conn(){
		return $this->_di->get('mysql');
	}
}
?>