<?php
/*!
 *	\class		Paging
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\version	1.0	
 *	\brief		페이징 처리
 *	\date		2012.03.06 - 기존 단순 스킨이었던 방식을 모듈화 하였음
 */
class Paging extends Module
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
	
	public function tot($value) {
		$this->SetConfig('tot','',$value);
		return $this;
	}
	public function rows($value) {
		$this->SetConfig('rows','',$value);
		return $this;
	}
	public function nWidth($value) {
		$this->SetConfig('nWidth','',$value);
		return $this;
	}
	
	public function CurrentPage() {
		$kn = $this->Config('key');
		// 현재 페이지 
		$key = GV::Number($kn);
		if(!$key) $key = 1;
		return $key;
	}
	
	public function Sql($rows) {
		$page = intval($this->CurrentPage())-1;
		return ($page*intval($rows)).','.intval($rows);
	}
	
}