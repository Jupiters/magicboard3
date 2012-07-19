<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * 데이터베이스에 입력할 때에
 * xss필터를 적용해줌
 */

$result = Filter::Inst()->Get('html',$att[1]);


