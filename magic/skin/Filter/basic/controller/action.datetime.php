<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 날짜 시간을 검사
 */
$result = '';
$pattern = '/[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}/';
if(preg_match($pattern, $att[1], $matches)) {
	$datetime = explode(' ', $matches[0]);
	$date = $this->Action('date',$datetime[0]);
	$time = $this->Action('time',$datetime[1]);

	if($date!='' && $time!='') $result = $matches[0];
}