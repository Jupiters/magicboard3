<?php
class Board extends Module
{
	protected static $inst;			///< 모듈 인스턴스 
	protected $bo_id;				///< 게시판 아이디
	protected $board=array();		///< 게시판 정보
	
	public static function Inst() {
		if(!isset(self::$inst)) {
			$class_name = __CLASS__;
			self::$inst = new $class_name();
		}
		return self::$inst;
	}
	
	protected function __construct() {
		parent::__construct(__CLASS__, 'basic');
	}
	
	public function bo_no($key) {
		$this->FetchByKey($key);
		return self::$inst;
	}
	
	protected function FetchByKey($bo_no) {
		$retult = $this->Sql('fetch_key',$bo_no);
		if(!$this->board[$retult['bo_id']]) $this->board[$retult['bo_id']] = $retult;
		if(!$this->board[$retult['bo_id']]) Dialog::Alert('게시판 번호가 잘못 됐습니다.');
		return $this->board[$retult['bo_id']];
	}
	
	public function GetConfig() { return $this->board[$this->bo_id]; }
	public function __get($name) { return $this->board[$this->bo_id][$name]; }
}
