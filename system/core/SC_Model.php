<?php
class SC_Model {
	private $_di;
	
	function __construct(){
		DI::set('mysql', Factory::mysql_conn());
		$this->_di=Factory::DI();
	}
	
	protected function conn(){
		return $this->_di->get('mysql');
	}
}
?>