<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * boolean값을 검사함, 데이터베이스의 BOOL타입 tinyint(1)값을 검사함 1/0
 */
$result = 0;
if($att[1]=='1' || $att[1]==1)
	$result = 1;