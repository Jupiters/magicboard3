<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

// 필더링된 결과 값을 건내줌
$clear = GV::Clear($this->TBN());

// 포함시킬 결과값
$include = array(
	'mb_id',
	'mb_passwd',
	'mb_nick',
	'mb_email',
	'mb_memo',
	'mb_question',
	'mb_answer'
);

$result = array();
foreach ($clear as $k=>$v) {
	if(in_array($k, $include)) {
		$result[$k] = $v;
	}
}