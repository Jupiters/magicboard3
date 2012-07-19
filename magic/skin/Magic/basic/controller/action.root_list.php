<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

/*
 * 루트 목록을 구함 
 */
$result = array();
foreach($this->list_root as $v) {
	$v['link'] = Path::Root('/?'.$this->Config('root').'='.$this->root['m_id']);
	if($this->root['m_no']==$v['m_no']) $v['active'] = true;
	$result[$v['m_order'].$v['m_no']] = $v;
}
ksort($result);

