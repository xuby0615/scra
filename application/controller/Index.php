<?php
/*
 * Defalut Controller  
 * You can change default controller in file: 
 * 		application/config/const.php
 * 
 * @Author:	Xuby
 * @Time:	2016-2-18 13:19:37
 */

class Index extends Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	public function home(){
		include V.'index.php';
	}

}