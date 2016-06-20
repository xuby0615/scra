<?php
class DI{
	protected static $objects;

	public static function set($key,$object){
		self::$objects[$key] = $object;
	}

	public static function get($key){
		if (array_key_exists($key, self::$objects)){
			return self::$objects[$key];
		}else{
			echo 'class:"'.$key.'" does not registration.';
		}
	}
	
	public static function delete($key){
		unset(self::$objects[$key]);
	}

}

?>