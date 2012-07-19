<?php if(!defined("__MAGIC__")) exit; 
/*
 * 메뉴목록을 재정렬함
 */

$list_all = $this->Sql('list');

// 최상위 리스트 구하기
$list = array();
foreach($list_all as $v) {
	if($v['m_parent']==0) {
		$v['children'] = array();
		$list[$v['m_no']] = $v;
	}
}

// 메인메뉴 구하기
foreach($list_all as $v) {
	if($list[$v['m_parent']]) {
		$v['children'] = array();
		$list[$v['m_parent']]['children'][$v['m_no']] = $v;
	}
}

// 서브메뉴 구하기
foreach($list_all as $v) {
	foreach($list as $kk=>$vv) {
		if($vv['children'][$v['m_parent']]) {
			$v['children'] = array();
			$list[$kk]['children'][$v['m_parent']]['children'][$v['m_no']] = $v;
		}
	}
}

$this->list = $list;

Scripts::Add(Path::Group('magic/js/plugin/jquery.jstree.js'));
