<?php

class Config{

	private static $_data;
	private static $_instance;
	
	public function __construct() { } 
	
	public static function getInstance(){
		if (!self::$_instance){
			self::$_instance = new Config();
		}
		return self::$_instance;
	}
	
	public static function __set($name,$value){
		self::$_data[$name] = $value;
	}
	public static function __get($name){
		return self::$_data[$name];
	}
	
	public static function set($k, $v)
        {
                return self::$_data[$k] = $v;
        }

        public static function get($k)
        {
                return self::$_data[$k];
        }	
}

/*A puesedo function for options.*/
function getOption($name,$set = false) {
	if ($set){ return Config::set($name,$set); }
	else { return Config::get($name); }
}

/*Get a POSTED variable*/ 
function getVar($name){
if (isset($_POST[$name])) {
return strip_tags($_POST[$name], getOption('allowHTML'));
}
else {
return false;
}
}
