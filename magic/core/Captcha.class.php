<?php
/*!
 *	\class		Captcha
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\version	1.0	
 *	\brief		캡챠모듈
 *	\date		2012.03.07 - 생성
 */
class Captcha extends Module
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
	
	public function Msg($v) {
		$this->SetConfig('msg','',$v);
		return $this;
	}
	
	public function MsgPos($v) {
		$this->SetConfig('position','',$v);
		return $this;
	}
	
	public function Check() {
		return $this->Action('check');
	}
}
