<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */
$result = array();
foreach($this->list_sub as $v) {
	$v['popup'] = false;
	if($v['m_redirection']) {
		$v['link'] = $v['m_redirection'];
		if(strpos($v['m_redirection'],'http://')!==false) {
			$v['popup'] = true;
		}
	} else {
		$v['link'] = Path::Root('/?'.$this->Config('root').'='.$this->root['m_id'].'&'.$this->Config('main').'='.$this->main['m_id'].'&'.$this->Config('sub').'='.$v['m_id']);
	}
	$result[$v['m_order'].$v['m_no']] = $v;
}

