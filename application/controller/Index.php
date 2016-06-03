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
		$smarty->assign('server',$_SERVER['SERVER_SOFTWARE']);
		$smarty->display('index.php');
	}
}