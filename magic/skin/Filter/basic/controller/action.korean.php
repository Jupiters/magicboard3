<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 한글만 걸러냄 한글사이에 공백은 유지 시켜준다.
 * 나중에 필요없으면 지우자
 */

$pattern = '![^\x{0020}\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+!u';
$result = preg_replace('/\s\s+/', ' ', preg_replace($pattern,'',$att[1]));  