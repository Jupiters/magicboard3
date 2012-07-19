<?php if(!defined("__MAGIC__")) exit; 

if(!$this->Can('delete')) {
	Dialog::alert("삭제할 권한이 없습니다.");
}