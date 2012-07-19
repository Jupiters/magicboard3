<?php
/*!
 *	\class		Page
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\brief		매직 보드에서 가장 기본이 되는 클래스 \n
				기본적인 페이지 출력을 담당한다. \n
				상속받으면 기본적인 초기화, 권한함수들을 호출해 준다. \n
				해당 페이지에 대해서 스타일과 스크립트 사용 유무를 설정받아 PageHead 클래스에 추가해준다.\n
				\n
				<b>주요함수</b>
				- Init()
				- skin()
				- css()
				- js()
				- CreateHtml()
 *	\version	1.0
 *	\date		2009.10.16 - 생성
 *	\date		2010.01.14 - State 함수를 추가하고, skin,css,js등의 함수를 효율적으로 변경
 */
class Page
{
	const page_element = 'element';			///< define page element state
	
	protected $prefix;		///< 파일명 설정 (skin, css, js)
	protected $use_style;	///< css 파일 사용유무
	protected $use_script;	///< js 파일 사용유무
	protected $html;		///< HTML source

	/*! 
	 *	\fn		__construct($prefix, $use_style=true, $use_script=false)
	 *	\brief	기본생성자\n
	 *			스타일과 자바스크립트의 인크루드 유무를 받아서 설정하고,\n
	 *			인크루드할 이름($prefix)를 매개변수로 받아서 설정한다.\n
	 *			템플릿 메소드로 Init(), CheckAuth() 를 호출하여 하위클래스에서 초기화와 권한 검사를 수행하도록 강요하고\n
	 *			$prefix 를 활용하여 스타일과 자바스크립트 파일을 인크루드 한다.
	 *	\param	prefix		스킨과, 스타일시트, 자바스크립트의 파일명
	 *	\param	use_style	스타일시트 사용유무
	 *	\param	use_script	자바스크립트 사용유무
	 */
	public function __construct($prefix, $use_style=true, $use_script=false) {
		$this->prefix = $prefix;
		$this->use_style = $use_style;
		$this->use_script = $use_script;
		$this->Init();
		$this->CheckAuth();
		Styles::Add($this->css());
		Scripts::Add($this->js());
	}

	/*! 
	 *	\fn		__toString()
	 *	\brief	"echo $element" 형식으로 사용하기위한 시스템 함수 오버라이딩
	 *	\return	string html 코드 반환
	 */
	public final function __toString() {$this->CreateHtml(); return $this->html;}

	/*! 
	 *	\fn		html()
	 *	\brief	html 코드 반환\n
	 *			__toString()함수를 강제로 호출하여 html을 반환하여 준다.
	 *	\return	string html 코드 반환
	 */
	public final function html() {return $this->__toString();}

	/*! 
	 *	\fn		CreateHtml()
	 *	\brief	HTML code를 생성\n
	 *			skin() 함수를 이용해서 스킨파일을 인크루드하고\n
	 *			스킨파일을 이용하여 생성된 HTML코드를 $html 멤버변수에 저장한다.
	 */
	protected function CreateHtml() {
		ob_start();
		include($this->skin());
		$this->html = ob_get_contents();
		ob_end_clean();
	}

	/*! 
	 *	\fn		State()
	 *	\brief	현재 상태를 반환\n
	 *			Page Class 단독으로 쓰일때에는 단순하게 페이지 일부분을 출력하기 위하여 page_element라는 상태를 따로 두었음\n
	 *			page_element 상태에서는 ($prefix).php 같은 형식으로 출력함.
	 *	\return string 현재 상태
	 */
	protected function State() { return self::page_element; }

	/*! 
	 *	\fn		CreateFileName($type, $except_state, $mode='')
	 *	\brief	State() 별로 파일명을 생성함.\n
	 *			상태가 있으면 상태에 맞는 파일명을 생성해준다.\n
	 *			page_element상태나 $except_state 목록에 있는 상태는 단순 파일명+타입으로 생성하고\n
	 *			이외의 파일은 파일명+상태+타입 으로 파일명을 생성한다.
	 *	\date	2010.01.15 - Write class에서 mode에 상관없이 강제로 출력하는 옵션이 있어서 $mode 추가함.
	 *	\return	string 파일명
	 */
	protected final function CreateFileName($type, $except_state, $mode='') {
		$file='';
		$state = $this->State();
		if($mode) $state = $mode;
		if($state!='')
		{
			$file = $this->prefix;
			if($state!=self::page_element && !in_array($state, $except_state)) $file.='.'.$state;
			$file.='.'.$type;
		}
		return $file;
	}

	/*! 
	 *	\fn		skin($except_state=array(), $mode='')
	 *	\brief	모드에 따른 파일명을 생성하여 반환해줌\n
	 *			Path::skin() 함수를 이용하여 해당 모드에 따른 스킨의 경로를 반환해준다.\n
	 *			상태화를 시킨 제외목록을 설정할 수 있으며, 상태를 강제로 설정가능함
	 *	\param	except_state 배열 제외시킬 상태
	 *	\param	mode 강제적용 모드	
	 *	\return	string 스킨 파일의 경로
	 */
	protected function skin($except_state=array(), $mode='') { return Path::skin($this->CreateFileName('php', $except_state, $mode)); }

	/*! 
	 *	\fn		css()
	 *	\brief	스타일의 사용유무에 따라 css파일명을 생성하여 반환하여줌\n
	 *			스타일을 사용하지 않을 시에는 공백문자를 반환함
	 *	\return	string css 파일명
	 */
	protected function css() { return $this->use_style?$this->prefix.'.css':''; }

	/*! 
	 *	\fn		js()
	 *	\brief	자바스크립트 사용유무에 따라 js파일명을 생성하여 반환하여줌\n
	 *			자바스크립트를 사용하지 않을 시에는 공백문자를 반환함
	 *	\return	string js 파일명
	 */
	protected function js() { return $this->use_script?$this->prefix.'.js':''; }

	/*! 
	 *	\fn		Init()
	 *	\brief	템플릿 메소드\n
	 *			자식 클래스에서 오버라이딩 하여서 사용해야 함\n
	 *			생성자를 호출할때 호출되는 함수로 html코드를 생성하기전\n
	 *			선행되어야할 작업들을 넣어준다.
	 */
	protected function Init(){}

	/*! 
	 *	\fn		CheckAuth()
	 *	\brief	템플릿 메소드\n
	 *			자식 클래스에서 오버라이딩 하여서 사용해야 함\n
	 *			생성자를 호출할때 호출되는 함수로 html코드를 생성하기전\n
	 *			권한 검사를 해야할 경우가 생길경우 오버라이딩 하여 권한검사 코드를 추가한다.
	 */
	protected function CheckAuth(){}
	
	/*! 
	 *	\fn		SetPrefix($prefix)
	 *	\brief	prefix 설정 변경\n
	 *			이전 설정된 css,js파일은 제거하고 새로 설정된 prefix를 이용해서 다시 설정한다.
	 *	\param	prefix 문자열 
	 */
	public function SetPrefix($prefix) {
		// prefix를 변경하면  이전에 설정되었던 css,js파일은 자동으로 제거된다.
		Styles::Del($this->css());
		Scripts::Del($this->js());
		$this->prefix = $prefix;
		// 이전 설정된 css,js파일은 제거하고 새로 설정된 prefix를 이용해서 설정한다.
		Styles::Add($this->css());
		Scripts::Add($this->js());
	} 
	
	/*! 
	 *	\fn		SetStyle($style)
	 *	\brief	css 파일 사용유무 설정
	 *	\param	style boolean css 파일 사용우뮤
	 */
	public function SetStyle($style) {
		$this->use_style = $style;
		if($this->use_style) {
			Styles::Add($this->css());
		} else {
			Styles::Del($this->css());
		}
	} 
	
	/*! 
	 *	\fn		SetScript($script)
	 *	\brief	js 파일 사용유무 설정
	 *	\param	script boolean js 파일 사용우뮤
	 */
	public function SetScript($script) {
		$this->use_script = $script;
		if($this->use_script) {
			Scripts::Add($this->js());
		} else {
			Scripts::Del($this->js());
		}
	} 
	
	public static function GetHtml(&$obj) { return $obj->html(); }
}