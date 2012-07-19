<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 해당 개시글이 새로운 글인지 검사함
 * $att[1] 첫번째 파라메터는 삭제할 파일번호다.
 */

$ago = strtotime('-1 day');
$datetime = strtotime($att[1]);

$result = false;
if($datetime>$ago)
	$result = true;
