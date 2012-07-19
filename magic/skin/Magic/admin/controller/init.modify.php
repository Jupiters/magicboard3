<?php if(!defined("__MAGIC__")) exit; 

$key = GV::Number($this->KN());
$view = $this->Sql('fetch',$key);
$list_all = $this->Sql('list');
$list = array();
$root_list = array();

// 최상위 리스트 구하기
foreach($list_all as $v) {
	if($v['m_parent']==0 && $v['m_no']!=$key) {
		$list[$v['m_no']] = array();
		$root_list[] = $v;
	}
}

// 메인메뉴 구하기
foreach($list_all as $v) {
	if(isset($list[$v['m_parent']]) && $v['m_no']!=$key) {
		$list[$v['m_parent']][] = $v;
	}
}

// 현재메뉴의 부모메뉴들을 찾음
// 링크를 거슬러 올라가야함
$menu_chain = array();
foreach($list_all as $v) {
	if($v['m_no'] == $key) {
		$menu_chain[] = $v;
		break;
	}
}

if($v['m_parent']!=0)
foreach($list_all as $vv) {
	if($vv['m_no'] == $v['m_parent']) {
		$menu_chain[] = $vv;
		break;
	}
}

if($vv['m_parent']!=0)
foreach($list_all as $vvv) {
	if($vvv['m_no'] == $vv['m_parent']) {
		$menu_chain[] = $vvv;
		break;
	}
}


$view['root'] = array_pop($menu_chain);
$view['main'] = array_pop($menu_chain);

// 하위 첫번째 메뉴 구하기
$child_first = '';
foreach($list_all as $v) {
	if($key == $v['m_parent']) {
		$link = './?'.Magic::Inst()->Config('root').'='.$view['root']['m_id'];
		// main이 있을때 즉 현재 아이디가 서브메뉴일때
		if($view['main']) {
			$link.='&'.Magic::Inst()->Config('main').'='.$view['main']['m_id'];
			$link.='&'.Magic::Inst()->Config('sub').'='.$v['m_id'];
		// main이 없을때 즉 현재 아이디가 메인 메뉴일때
		} else {
			$link.='&'.Magic::Inst()->Config('main').'='.$v['m_id'];
		}
		$v['link'] = $link;
		$child_first = $v;
		break;
	}
}

$view['child_first'] = $child_first;

$this->root_list = $root_list;
$this->list = $list;
$this->action = $this->Link('update');
$this->view = $view;



