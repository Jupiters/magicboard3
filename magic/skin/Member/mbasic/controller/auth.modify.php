<?php if(!defined("__MAGIC__")) exit; 

$check = $this->Can('modify');

if($check===false) {
	Dialog::alert("로그인이 필요한 서비스 입니다.");
}
