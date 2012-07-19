<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * cheditor에 입력할때에는 special char를 한번더 인코딩 해 주어야 함
 * &gt;이런식으로 되어 있던 문자들이 모두 < 디코딩되어서 들어감
 */
$result = htmlspecialchars($att[1]);
//$result = $att[1];

