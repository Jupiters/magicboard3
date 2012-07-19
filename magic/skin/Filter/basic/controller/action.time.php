<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 시간을 검증한다.
 * 정규식을 이용해 시간 패턴인지 검사하고,
 * 시간이 재대로된 시간인지도 검사해서 재대로된 시간이면 시간을 반환하고,
 * 아니면 공백을 반환한다.
 */
$result = '';
$pattern = '/[0-9]{2}:[0-9]{2}:[0-9]{2}/';
if(preg_match($pattern, $att[1], $matches)) {
	$hms = explode(':', $matches[0]);
	$h = intval($hms[0]);
	$m = intval($hms[1]);
	$s = intval($hms[2]);
	if($h>=0 && $h<=23) if($m>=0 && $m<=59) if($s>=0 && $s<=59) $result = $matches[0];
}