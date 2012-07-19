<?php if(!defined('__MAGIC__')) exit; 

$page = $this->Action('fetch_page');
$contents = array_filter(explode(',',$page['m_contents']));

if(sizeof($contents)!=0) {
	$tbn = $this->TBN();
	$key_name = $this->KN();
	$key = $page[$key_name];
	$field = 'm_contents';
	/*
	 * 컨텐츠의 위젯을 미리 html로 변환해 줌
	 * layout 결과를 받아서 하게되면 해당 위젯의 css,js가 인크루드 되지 못함
	 */
	foreach ($contents as $k => $v) {
		$contents[$k] = Widget::Inst()->Parse(
			$tbn,
			$key_name,
			$key,
			$field,
			$v,
      $k
		);
	}
}

echo Layout::Inst($page['m_layout'])->Contents($contents)->html();


