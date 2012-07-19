<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 날짜를 검증한다. 우선 입력받은 날짜의 패턴을 검사한후,
 * 재대로된 날짜인지 checkdate함수를 통해서 점검한다.
 * 재대로된 날짜가 아니라면 공백문자를 반환한다.
 */
$result = false;
$pattern = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
if(preg_match($pattern, $att[1], $matches)) {
	$ymd = explode('-', $matches[0]);
	if(checkdate(intval($ymd[1]), intval($ymd[2]), intval($ymd[0]))) $result =  $matches[0];
}