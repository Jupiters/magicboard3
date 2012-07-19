<?php
/*!
 *	\class		Comment
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0
 *	\date		2009.10.16
 *	\brief		댓글 클래스
 *	\bug 
 *	\warning 
 *	\update		2010.07.20 - 댓글은 Write와 다르게 처리 가능하도록 state를 따로 둠
				2010.07.21 - 클래스의 소스를 대거 정리함
				2011.12.29 - 댓글 클래스 모듈화, 게시글 테이블과 분리함
				2012.01.15 - 댓글 Ajax+jquery ui 적용
 */
class Comment extends Module
{
	protected static $inst=array();	///< 모듈 인스턴스 
	protected $wr_no;				///< 게시글번호
	protected $bo_no;				///< 게시판설정
	
	public static function Inst($skin='basic') {
		if(!isset(self::$inst[$skin])) {
			$class_name = __CLASS__;
			self::$inst[$skin] = new $class_name($skin);
		}
		return self::$inst[$skin];
	}
	
	/*
	 * 게시글 번호 설정
	 */
	public function wr_no($value) {
		$this->wr_no = $value;
		return $this;
	}
	
	/*
	 * 게시판 번호 설정
	 */
	public function bo_no($value) {
		$this->bo_no = $value;
		return $this;
	}
	
	protected function __construct($skin='basic') {
		parent::__construct(__CLASS__, $skin);
	}
	
}
