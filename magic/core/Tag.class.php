<?php
class Tag extends Module
{
	protected static $inst;			///< 모듈 인스턴스 
	protected $bo_no;				///< 게시판번호
	protected $wr_no;				///< 게시글번호
	
	public static function Inst($skin='basic', $bo_no=0, $wr_no=0) {
		$skin_name = $skin.$bo_no.$wr_no;
		if(!isset(self::$inst[$skin_name])) {
			$class_name = __CLASS__;
			self::$inst[$skin_name] = new $class_name($skin, $bo_no, $wr_no);
		}
		return self::$inst[$skin_name];
	}
	
	protected function __construct($skin, $bo_no, $wr_no) {
		$this->bo_no = $bo_no;
		$this->wr_no = $wr_no;
		parent::__construct(__CLASS__, $skin);
	}
	
	public function bo_no($v) {
		return self::Inst($this->skin, $v, $this->wr_no);
	}
	
	public function wr_no($v) {
		return self::Inst($this->skin, $this->bo_no, $v);
	}
}
