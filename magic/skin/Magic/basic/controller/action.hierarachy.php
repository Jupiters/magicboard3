<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

$result = array();
if($this->sub['m_no']) {
	$result[] = $this->sub;
}

if($this->main['m_no']) {
	$result[] = $this->main;
}

$rt = $this->root;
$rt['m_id'] = 'HOME';//Config::Inst()->hp_title;

$result[] = $rt;

