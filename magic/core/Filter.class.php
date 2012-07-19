<?php
/*!
 *	\class		Filter
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0	
 *	\brief		데이터를 걸러내 주는 함수의 모음
 *	\date		2010.01.19 - 생성
 *	\date		2012.03.12 - Module구조로 변경
 */
class Filter extends Module
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
	
	public function Get($type, $v) {
		return $this->Action($type, $v);
	}
	
	// Get parameter
	public function GetParam($value) {
		$pattern = '/[^a-zA-Z_0-9]/';
		return preg_replace($pattern, '', $value);
	}

}
