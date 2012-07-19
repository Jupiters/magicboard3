<?php if(!defined("__MAGIC__")) exit; 

$check = $this->Can('view');
if(!$check) {
	Dialog::alertNReplace("로그인이 필요한 서비스 입니다.\n로그인 하세요", htmlspecialchars_decode($this->Link('login')));
}
