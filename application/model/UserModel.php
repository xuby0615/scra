<?php

class UserModel extends Model{
	private $_conn;
	private static $table = 'user';
	
	function __construct(){
		parent::__construct();
		$this->_conn = $this->get_conn();
	}
	
	public function getAll(){
		return $this->_conn->getAll(self::$table);
	}
}

?>