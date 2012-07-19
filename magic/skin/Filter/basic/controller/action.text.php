<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 입력 받은 문자열을 텍스트로 모두 변형한다.
 * HTML 태그들은 &gt; 같은 문자로 모두 대채 함
 */
$result = htmlspecialchars($att[1]);