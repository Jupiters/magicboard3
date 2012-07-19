<?php if(!defined("__MAGIC__")) exit; 

		
$check = $this->Can('modify');
if(!$check){
	Dialog::alertNReplace("수정권한이 없습니다.");
}
