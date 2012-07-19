<?php
class OutLogin extends Module
{
	protected static $inst;			///< 모듈 인스턴스 
	public static function Inst($skin='basic') {
		if(!isset(self::$inst[$skin])) {
			$class_name = __CLASS__;
			self::$inst[$skin] = new $class_name($skin);
		}
		return self::$inst[$skin];
	}
	
	protected function __construct($skin) {
		parent::__construct(__CLASS__, $skin);
	}
}