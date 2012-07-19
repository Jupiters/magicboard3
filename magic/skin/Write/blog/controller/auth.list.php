<?php if(!defined("__MAGIC__")) exit; 

if(!$this->Can('list')) {
	Dialog::alert("목록을 볼 권한이 업습니다.");
}