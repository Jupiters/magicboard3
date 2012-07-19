<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * letsgolee님이 만든 필터는 데이터베이스 입력을 위한 것이여서..
 * 슬레시가 필요한 곳에는 다 입력이 되어 있다.
 * 그래서 출력해 주기위해서는 stripslashes함수를 이용하여 슬러시를 제거해 주어야함
 */

$result = nl2br(htmlentities($att[1]));
