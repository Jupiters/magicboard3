<?php
/*!
 *	\class		Message
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\version	1.0	
 *	\brief		쪽지
 *	\date		2011.10.26 - 생성
 */
class Message extends Module
{
	protected static $inst=array();	///< 메시지 모듈 풀링 인스턴스 
	
	/*! 
	 *	\fn		Inst($module, $skin='basic')
	 *	\brief	모듈의 인스턴스를 반환함
	 *			모듈은 모듈명과 스킨명의 조합으로 구분함
	 *			모듈은 풀링으로 관리되며 $inst에 모두 저장되고 
	 *			동일한 모듈이 호출되면 기존에 있던 인스턴스를 반환한다.
	 *			싱글톤 + 인스턴스 풀링이 개념이다. 
	 *	\param	$skin 스킨명
	 *	\return 해당 인스턴스
	 */
	public static function Inst($skin='basic') {
		if(!isset(self::$inst[$skin])) {
			$class_name = __CLASS__;
			self::$inst[$skin] = new $class_name($skin);
		}
		return self::$inst[$skin];
	}

	/*! 
	 *	\fn		__construct($skin='basic')
	 *	\brief	모듈의 생성자
	 *			모듈의 경로를 초기화 한다.
	 *	\param	$skin 스킨명
	 */
	protected function __construct($skin='basic') {
		parent::__construct(__CLASS__, $skin);
	}
	
	/*! 
	 *	\fn		State($name)
	 *	\brief	config의 state값을 반환
	 *	\param	$name state명 반환
	 *	\return	현재상태
	 */
	protected function State($name) {
		return $this->Config('state', $name);
	}
	
	/*! 
	 *	\fn		IsState($state, $check)
	 *	\brief	체크해야할 값이 체크되어 있는지 검사
	 *	\param	$state 체크해야할 state명
	 *	\param	$check 체크해야할 state값
	 *	\return	체크결과
	 */
	protected function IsState($state, $check) {
		return $this->Config('state', $state) & $check;
	}
	
	/*! 
	 *	\fn		Popup()
	 *	\brief	환경설정값은 팝업창 너비와 높이를 읽어들여
	 *			팝업생성 소스를 반환해줌
	 *	\return	팝업용 소스
	 */
	public function Popup() {
		$pop_width = $this->Config('pop_width');
		$pop_height = $this->Config('pop_height');
		return "window.open(this.href, '쪽지', 'width={$pop_width},height={$pop_height},history=no, resizable=no, status=no, scrollbars=yes, menubar=no'); return false;";
	}
	
	/*! 
	 *	\fn		IsNew()
	 *	\brief	새쪽지 갯수를 반환함
	 *	\return	새쪽지 갯수
	 */
	public function IsNew() {
		return $this->Sql('is_new');
	}

}