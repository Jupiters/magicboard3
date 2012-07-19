<?php if(!defined("__MAGIC__")) exit; 

$this->Action('logout');

if($_GET['ret_url']) {
	$url = $_GET['ret_url'];
} else {
	$url = Path::Group();
}

Dialog::alertNReplace("정상적으로 로그아웃 되었습니다.\n감사합니다.", $url);