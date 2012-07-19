<?php
/*!
 *	\class		Magic
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0
 *	\brief		메뉴 관리 클래스\n
				MVC패턴의 컨트롤러 클래스로서 메뉴에 관한 다양한 행동들을 정의한다.\n
				매뉴의 수가/수정/삭제/다양한 표현 등을 담당한다.
 *	\date		2010.12.09 - 생성
 *	\date		2011.12.08 - 모듈화 admin/basic 스킨을 기본으로 시작함
 *	\date		2012.01.30 - Magic 이라는 대표 클래스로 변경됨
 *							 사이트 전체적인 메뉴/레이아웃을 저장하고 관리하는 클래스임
 */
class Magic extends Module
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
