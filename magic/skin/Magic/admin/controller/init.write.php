<?php if(!defined("__MAGIC__")) exit; 


$list_all = $this->Sql('list');
$list = array();
$root_list = array();

// 최상위 리스트 구하기
foreach($list_all as $v) {
	if($v['m_parent']==0) {
		$list[$v['m_no']] = array();
		$root_list[] = $v;
	}
}

// 메인메뉴 구하기
foreach($list_all as $v) {
	if(isset($list[$v['m_parent']])) {
		$list[$v['m_parent']][] = $v;
	}
}

$this->root_list = $root_list;
$this->list = $list;
$this->action = $this->Link('insert');



