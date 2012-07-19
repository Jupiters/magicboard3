<?php
/*!
 *	\class		Search
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\version	1.0	
 *	\brief		검색폼
 *	\date		2011.11.04 - 생성
 *	\date		2011.11.24 - 심플하게 static 클래스로 변경 ㅡ module/skin 구조는 피함
 *	\date		2012.03.06 - module구조로 변경 모든 곳에서 검색은 비슷한 구조로 사용됨
 */
class Search extends Module
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
	
	public function Msg($msg) {
		$this->SetConfig('msg','',$msg);
		return $this;
	}
	
	/*
	 * SQL검색 문장 생성
	 */
	public function Sql($fields) {
		$stx = GV::String($this->Config('key'));
		if(!$stx || !is_array($fields)) return '';
		$sql='AND (';
		foreach ($fields as $k=>$v) {
			$fields[$k] = $v." LIKE '%{$stx}%' ";
		}
		$sql.=implode(' OR ', $fields);
		$sql.=')';
		return $sql;
	}

}