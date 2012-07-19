<?php
/*!
 *	\class		Editor
 *	\brief		에디터 출력
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Department of Computer Science, Inje Univ.
 *	\version	1.0
 *	\date		2010.01.04 - 생성
 *	\date		2012.03.04 - 에디터 전체를 모듈로 분리하여 스킨화
 */
class Editor extends Module
{
	protected static $inst;			///< 모듈 인스턴스 
	protected $name;				///< 폼 네임
	protected $contents;			///< 컨텐츠
	
	public static function Inst($name, $skin='basic') {
		$skin_name = $name.$skin;
		if(!isset(self::$inst[$skin_name])) {
			$class_name = __CLASS__;
			self::$inst[$skin_name] = new $class_name($name, $skin);
		}
		return self::$inst[$skin_name];
	}
	
	protected function __construct($name, $skin) {
		$this->name = $name;
		parent::__construct(__CLASS__, $skin);
	}
	
	public function width($v) {
		$this->SetConfig('width', '', $v);
		return $this;
	}
	
	public function height($v) {
		$this->SetConfig('height', '', $v);
		return $this;
	}
	
	public function rows($v) {
		$this->SetConfig('rows', $v);
		return $this;
	}
	
	public function css_class($v) {
		$this->SetConfig('class', $v);
		return $this;
	}
	
	/*
	 * 데이터베이스 집어넣을 때
	 */
	public function db_in($v) {
		return $this->Action('db_in', $v);
		
	}
	
	/*
	 * 데이터베이스에서 가져올 때
	 */
	public function db_out($v) {
		return $this->Action('db_out', $v);
	}
	
	/*
	 * 데이터베이스에서 가져올 때
	 * 에디터에 수정데이터를 넣을 때
	 */
	public function db_edit($v) {
		$this->contents = $this->Action('db_edit', $v);
		return $this;
	}

}
