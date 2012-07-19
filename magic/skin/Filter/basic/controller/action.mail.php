<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 메일주소 검증 메일주소가 검증되지 않았을시 false 리턴함
 */

if(preg_match('/([a-zA-Z0-9_-]+)@([a-zA-Z0-9_.-]+)/', $att[1], $matches)) {
	$result = $matches[0];
} else {
	$result = false;
}