<?php
/*
 *  Defalut Controller  
 *  You can change default controller in file: 
 * 		application/config/config.php
 */

class Index extends Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	public function home(){
		$smarty = $this->smarty();
		$smarty->display('index.php');
	}

}