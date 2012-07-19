<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

$mb_no = $this->Action('is_login');
if($mb_no) {
    $this->member = $this->Sql('fetch', $mb_no);
} else {
	$m['mb_no'] = 0;
	$m['mb_nick'] = '손님';
	$m['mb_level'] = 1;
	$this->member = $m;
}
$result = $this->member;