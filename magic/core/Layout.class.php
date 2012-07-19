<?php
/*!
 *	\class		Layout
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0
 *	\date		2012.01.15
 *	\brief		레이아웃 클래스
 *	\bug 
 *	\warning 
 *	\update		2012.01.15 - 레이아웃도 모듈로 제작
 */
class Layout extends Module
{
	protected static $inst=array();	///< 모듈 인스턴스 
	protected $contents;			///< 컨텐츠
	
	public static function Inst($skin='basic') {
		if(!isset(self::$inst[$skin])) {
			$class_name = __CLASS__;
			self::$inst[$skin] = new $class_name($skin);
		}
		return self::$inst[$skin];
	}
	
	protected function __construct($skin='basic') {
		parent::__construct(__CLASS__, $skin);
	}
	
	public function Contents($contents) {
		$this->contents = $contents;
		return $this;
	}
	
	/*! 
	 *	\fn		CreateHtml()
	 *	\brief	부모함수 재정의
	 *			PageCreator에서 추가했던 header를 여기서 추가함
	 */
	protected function CreateHtml() {
    // 레이아웃 미리보기
    // 임시로 다른 레이아웃을 적용하여 보여줌
		$preview = GV::String('preview_layout');
		if($preview) {
      $this->Skin($preview);
		}

		$this->Init();
		ob_start();
		echo PageElement::Inst('header')->html();
		include($this->path_view($this->CurrentState().'.php'));
		$this->html = ob_get_contents();
		ob_end_clean();
		$this->html = $this->Parse($this->html);
	}
	
	public function FindContents() {
		return $this->ParseContents(file_get_contents($this->path_view($this->CurrentState().'.php')));
	}
	
	/*
	 * [[contents]] 요런식의 표현식을 찾아서 치환
	 */
	protected function ParseContents($contents) {
				
		$pattern = "/(\[\[contents\]\])/";
		preg_match_all($pattern, $contents, $matches);
		
		$result = array();
		foreach ($matches[0] as $v) {
			$result[] = $v;
		}
		return $result;
	}
	
	/*
	 * [[contents]] 요런식의 표현식을 찾아서 치환
	 */
	protected function Parse($contents) {
				
		/*
		 * 표현식과 문자열을 분리
		 */
		$split = preg_split("/(\[\[contents\]\])/", $contents);

		/*
		 * 매칭된 문장의 갯수만큼 루프를 돌면서 변환함
		 * 위젯이 설정되지 않았을 경우 : 링크로 스킨 변경 팝업창을 호출 하도록 함
		 * 위젯이 이미 설정되어 있는 경우 : 위젯 스킨을 호출하여 HTML로 출력해줌
		 */
		$result='';
		for($i=0; $i<count($split); $i++) {
			$result.=$split[$i];
			$result.=$this->contents[$i];
		}
		
		return $result;
	}
	
}
