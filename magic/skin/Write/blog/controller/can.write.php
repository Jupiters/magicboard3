<?php if(!defined("__MAGIC__")) exit; 

$pass=false;
if(
	$this->Config('mb','admin') ||
	$this->Config('mb','level') >= intval(Board::Inst()->bo_no($this->bo_no)->bo_level_write)
) $pass=true;
