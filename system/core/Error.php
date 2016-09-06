<?php
class Error{

	public static function customError($errno, $errstr, $errfile, $errline)
	{ 
		echo "<b>Custom error:</b> [$errno] $errstr<br />";
		echo " Error on line $errline in $errfile<br />";
		echo " Ending Script";
		die();
	}
}