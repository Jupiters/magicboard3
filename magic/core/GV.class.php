<?php
/*!
 *	\class		GV
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0	
 *	\brief		Global Variables
				POST/GET으로 넘어오는 데이터 들을 검증함
				데이터베이스에 입력하기전에...
				모든 데이터를 검증할 필요가 있음.
 *	\date		2010.01.19 - 생성
 */
class GV
{
	const num	= 'number';	///< 숫자 데이터
	const date	= 'date';	///< 날짜 데이터
	const time	= 'time';	///< 시간 데이터
	const datetime = 'datetime'; ///< 날짜/시간 데이터
	const bool	= 'bool';	///< 참/거짓값 : 참거짓 값인지 판별함

	const id	= 'id';		///< 아이디 데이터 영문 숫자의 조합
	const passwd= 'passwd';	///< 패스워드 데이터
	const eng	= 'english';///< 영문 데이터 : 대소문자 구별없는 영문만 남기고 반환함
	const kor	= 'korean';	///< 한글 데이터 : 한글만 남기고 반환함
	const ip	= 'ip';		///< ip
	const mail	= 'mail';	///< 메일 : 메일 형식이 맞는지 체크한다.
	const str	= 'string';	///< 문자열 데이터 : 특수문자를 제외한 한글/영문/숫자

	const html	= 'html';	///< html데이터 : html 원본 그대로 저장함
	const text	= 'text';	///< 텍스트 데이터 : html문자는 &;등으로 변환

	/*
	public static function GenType($values) {
		$gen_type='';
			 if($values['Type'] == 'tinyint(1)') $gen_type = self::bool;
		else if($values['Type'] == 'datetime') $gen_type = self::datetime;
		else if($values['Type'] == 'date') $gen_type = self::date;
		else if($values['Type'] == 'time') $gen_type = self::time;
		else if(strstr($values['Type'], 'int')) $gen_type = self::num;
		else if(strstr($values['Type'], 'char'))
		{
			if(strpos($values['Field'], 'ip')) $gen_type = self::ip;
			else if(strpos($values['Field'], 'password') || strpos($values['Field'], 'passwd')) $gen_type = self::passwd;
			else if(strpos($values['Field'], 'id')) $gen_type = self::id;
			else if(strpos($values['Field'], 'mail')) $gen_type = self::mail;
			else $gen_type = self::str;
		}
		else if(strstr($values['Type'], 'text'))
		{
			$gen_type = self::text;
		}
		return $gen_type;
	}
	//*/

	// define _GET method parameter
	const check = 'check';
	const page = 'page';
	const search = 'search';
	const category = 'category';
	const password = 'password';
	const prev_url = 'prev_url';
	// output
	const output= 'output';
	const toPdf = 'pdf';
	const toXls = 'xls';
	const toPrinter = 'printer';
	
	static function Check() {
		return Filter::Inst()->Get('bool',$_GET[self::check]);
	}
	
	static function Page() { return Filter::Number($_GET[self::page]); }
	static function search() { return Filter::String(urldecode(self::Anything(self::search))); }
	static function Output() { return Filter::English($_GET[self::output]); }
	static function Category() {
		return Filter::Inst()->Get('string',$_GET[self::category]);
	}
	static function Password($name=self::password, $method='ALL') {
		return Filter::Inst()->Get('password',self::GetParam($name, $method));
	}
	static function Id($name, $method='ALL') {
		return Filter::Inst()->Get('id',self::GetParam($name, $method));
	}
	static function Number($name, $method='ALL') {
		return Filter::Inst()->Get('number',self::GetParam($name, $method));
	}
	static function PrevUrl($method='ALL') { return urldecode(self::GetParam(self::prev_url,$method)); }
	static function String($name, $method='ALL') {
		return Filter::Inst()->Get('string',self::GetParam($name, $method));
	}

	static function Mode($check='') {
		if($check=='') return Filter::GetParam($_GET[mode]);
		else {
			if($check==Filter::GetParam($_GET['mode'])) return true;
			else return false;
		}
	}

	// initial a post and a get variables.
	static function Init() {
		self::SupportShortVariables();
		self::SetRegisterGlobalsOff();
		self::SetMagicQuotesGpcOff();

		// add slashes
		foreach($_POST as $k => $v) {
			if(is_array($v)) {
				foreach($v as $kk => $vv) {
					$_POST[$k][$kk] = addslashes($vv);
				}
			} else {
				$_POST[$k] = addslashes($v);
			}
		}

		foreach($_GET as $k => $v) {
			//$_GET[$k] = addslashes(urlencode($v));
			$_GET[$k] = addslashes($v); // 검색 문제로 자동 인코드 중지
		}
		
		foreach($_COOKIE as $k => $v) {
			$_COOKIE[$k] = addslashes($v);
		}
	}

	// if not support short grobal variables, will be avariable.
	static function SupportShortVariables() {
		if (isset($HTTP_POST_VARS) && !isset($_POST)) {
			$_POST   = &$HTTP_POST_VARS;
			$_GET    = &$HTTP_GET_VARS;
			$_SERVER = &$HTTP_SERVER_VARS;
			$_COOKIE = &$HTTP_COOKIE_VARS;
			$_ENV    = &$HTTP_ENV_VARS;
			$_FILES  = &$HTTP_POST_FILES;

			if (!isset($_SESSION))
				$_SESSION = &$HTTP_SESSION_VARS;
		}
	}

	// force to set register globals off
	// http://kldp.org/node/90787
	static function SetRegisterGlobalsOff() {
		if(ini_get('register_globals')) {
			foreach($_GET as $key => $value) { unset($$key); }
			foreach($_POST as $key => $value) { unset($$key); }
			foreach($_COOKIE as $key => $value) { unset($$key); }
		}
	}

	// if get magic quotes gpc is on, set off
	static $off=false;
	static function SetMagicQuotesGpcOff() {
		// set magic_quotes_gpc off
		if (!self::$off && get_magic_quotes_gpc()) {
			function stripslashes_deep($value) {
				$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
				return $value;
			}

			$_POST = array_map('stripslashes_deep', $_POST);
			$_GET = array_map('stripslashes_deep', $_GET);
			$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
			$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
		}
	}


	public static function GetParam($name, $method='POST') {
		$value='';
		switch(strtoupper($method)) {
			case 'ALL': $value = self::Anything($name); break;
			case 'GET': $value = $_GET[$name]; break;
			case 'POST': $value = $_POST[$name]; break;
		}
		return $value;
	}
	// basic function for getting param
	public static function Anything($key) {
		return $_POST[$key]?$_POST[$key]:$_GET[$key];
	}

	/*
		필터 등을 적용하여 POST/GET 데이터를 받아옴
		$queryList	=> POST/GET 형식의 데이터를 받아오는 리스트 [이름=>[POST/GET/ALL,필터키]] 형식으로 정의됨
		$filterList	=> 필터 종류를 정의해 놓은 배열 [반환키=>필터종류] 형식으로 정의됨
	static function Clear($tbn, $except=array(), $method=array(), $filter_method=array()) {
		$valid=array();

		$fields=DB::DescTable($tbn);

		foreach($fields as $k => $v) {
			// 제외할 것 제거
			if(in_array($k, $except)) continue;

			if(!isset($_POST[$k]) && !isset($_GET[$k])) continue;

			// POST/GET으로 데이터 받아오기
			if($method[$k]) $value = self::GetParam($k, $method[$k]);
			else $value = self::GetParam($k, 'POST');

			if(isset($filter_method[$k])) $v = $filter_method[$k];

			switch($v) {
				case self::num:		$cleared=Filter::Number($value); break;
				case self::id:		$cleared=Filter::ID($value); break;
				case self::passwd:	$cleared=Filter::Passwd($value); break;
				case self::str:		$cleared=Filter::String($value); break;
				case self::eng:		$cleared=Filter::English($value); break;
				case self::kor:		$cleared=Filter::Korean($value); break;
				case self::mail:	$cleared=Filter::Mail($value); break;
				case self::html:	$cleared=Filter::Html($value); break;
				case self::text:	$cleared=Filter::Text($value); break;
				case self::date:	$cleared=Filter::Date($value); break;
				case self::time:	$cleared=Filter::Time($value); break;
				case self::datetime:$cleared=Filter::Datetime($value); break;
				case self::bool:	$cleared=Filter::Bool($value); break;
				default: $cleared=Filter::String($value);
			}
			if(isset($cleared)) $valid[$k]=$cleared;
		}
		return $valid;
	}
	*/

}
