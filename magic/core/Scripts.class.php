<?php
/*!
 *	\class		Module
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\version	1.0	
 *	\brief		js 파일 인크루드
 *	\date		2009.??.?? - 처음버전은 언제인지 기억도 안남..
 *	\date		2012.04.04 - 대대적인 업데이트? 그냥 심플하게 js에 경로를 포함한 완전한 html이 들어가도록 수정
 */
class Scripts
{
	static $js = array();

	// 스크립트  추가 중복 되지 않도록 검사후 추가
	static function Add($src, $source='') {
		if(!$src && $source=='') return;
		$html = self::createHtml($src, $source);
		if(in_array($html, self::$js)) return;
		self::$js[] = $html;
	}

	// 입력될 html 소스 생성
	static function createHtml($src, $source) {
		$html = '<script type="text/javascript" ';
		if($src!='') $html.='src="'.$src.'"';
		$html.= '>';
		if($source!='') $html.= "\n//<![CDATA[\n{$source}\n//]]>\n";
		$html.= '</script>';
		return $html;
	}
	
	// 스크립트 제거
	static function Del($src, $source='') {
		if(!$src && $source=='') return;
		$html = self::createHtml($src, $source);
		if(FALSE !== ($key = array_search($html, self::$js))) {
			unset(self::$js[$key]);
		}
	}

	static function Get() { return self::$js; }
}

/*
 * magic/js/ 폴더의 파일은 모두 인크루드함
 */
$core_js = array();
$dir = dir(Path::MB_js());
while($name = $dir->read()) {
	if(is_file(Path::MB_js($name))) {
		$core_js[] = Path::MB_js($name);
	}
}
asort($core_js);
foreach($core_js as $v) {
	Scripts::Add($v);
}
unset($v);
unset($core_js);


