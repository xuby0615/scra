<?php
$smarty_config = array(
	'template_dir' 		=> V,
	'compile_dir' 		=> APP_PATH.'cache/compile',
	'cache_dir'	   		=> APP_PATH.'cache/cache',
	'caching'      		=> true,             //这里是调试时设为false,发布时请使用true
	'left_delimiter' 	=> '{',
	'right_delimiter' 	=> '}',
	'compile_check' 	=> true,
	'debugging' 		=> false,
);