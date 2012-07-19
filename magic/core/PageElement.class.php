<?php
/*!
 *	\class		PageElement
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0
 *	\date		2012.01.15
 *	\brief		페이지 엘리먼드
 *				상단, 사이드 등 페이지의 부분을 스킨화함
 *	\bug 
 *	\warning 
 *	\update		2012.01.15 - 페이지 엘리먼트 도 모듈로 제작
 */
class PageElement extends Module
{
	protected static $inst=array();	///< 모듈 인스턴스 
	
	public static function Inst($skin='header') {
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
