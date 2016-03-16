<?php
	class DI{
		protected static $objects;

		public static function set($key,$object){
			self::$objects[$key] = $object;
		}

		public static function get($key){
			return self::$objects[$key];
		}

		public static function delete($key){
			unset(self::$objects[$key]);
		}
	}

?>