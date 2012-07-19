<?php
/*!
 *	\class		Member
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0
 *	\brief		회원관련 기본정보등을 쉽게 구할수 있는 클래스\n
 *				회원관련 가입/탈퇴/정보수정/비밀번호 찾기 등을 수행하는 클래스
 *	\date		2010.09.08 - 생성
 *	\date		2011.01.02 - 싱글톤 패턴 적용과, MVC패턴으로 변화
 *	\date		2011.01.05 - MemberEdit 클래스와 통합 완료
 *	\date		2011.12.03 - Member 클래스 모듈화
 */
class Member extends Module
{
	protected static $inst=array();	///< 모듈 인스턴스
  protected $key;
	protected $member;				///< 회원정보
	
	public static function Inst($skin='basic', $mb_no='') {
    $skin_name = $skin.$mb_no;
		if(!isset(self::$inst[$skin_name])) {
			$class_name = __CLASS__;
			self::$inst[$skin_name] = new $class_name($skin, $mb_no);
		}
		return self::$inst[$skin_name];
	}
	
	protected function __construct($skin, $mb_no) {
    $this->skin = $skin;
    $this->key = $mb_no;
		parent::__construct(__CLASS__, $skin);
	}
	
	public function mb_no($v) {
		return self::Inst($this->skin, $v);
	}
	
	public function mb_id($v) {
		$this->member = $this->Sql('fetch_by_id', $v);
		return $this;
	}
	
	public function __get($name) { 
    if(!isset($this->member)) {
      if(is_file($this->path_controller('action.load.php')))
        $this->Action('load');
    }
		return $this->member[$name];
	}

}
