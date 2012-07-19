<?php
/*!
 *	\class		Module
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\version	1.0	
 *	\brief		css 파일 인크루드
 *	\date		2009.??.?? - 처음버전은 언제인지 기억도 안남..
 *	\date		2012.04.04 - 대대적인 업데이트? 그냥 심플하게 css에 경로를 포함한 완전한 html이 들어가도록 수정
 */
class Styles
{
	static $css = array();

	// 스타일 추가 중복 스타일 추가되지 않도록 검사후 추가
	static function Add($href) {
		if(!isset($href)) return;
		$source = '<link rel="stylesheet" href="'.$href.'" type="text/css"/>';
		if(in_array($source, self::$css)) return;
		self::$css[] = $source;
	}
	
	// 스타일 제거
	static function Del($href) {
		if(!isset($href)) return;
		$source = '<link rel="stylesheet" href="'.$href.'" type="text/css"/>';
		if(FALSE !== ($key = array_search($source, self::$css))) {
			unset(self::$css[$key]);
		}
	}

	static function Get() { return self::$css; }
}

// mb_js, mb_css에 있는 파일은 자동으로 인크루드 함
$dir = dir(Path::MB_css());
while($name = $dir->read()) {
	if(is_file(Path::MB_css($name))) {
		Styles::Add(Path::MB_css($name));
	}
}

