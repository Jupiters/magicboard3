<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

$list = $this->Sql('list');

// 최상위 리스트 구하기
$result = array();
foreach($list as $v) {
	if($v['m_parent']==0) {
		$result[$v['m_no']] = $v;
	}
}

