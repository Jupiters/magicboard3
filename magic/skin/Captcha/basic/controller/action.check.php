<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 */

include_once $this->path_view('zmSpamFree.php');
if ( !zsfCheck( $_POST['zsfCode'] ) ) {
	Dialog::Alert('스팸차단코드가 틀렸습니다.');
}
$result = true;
	