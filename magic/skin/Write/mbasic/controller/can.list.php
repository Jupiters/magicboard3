<?php if(!defined("__MAGIC__")) exit; 

$pass=false;
if(
	$this->Config('mb','admin') ||
	$this->Config('mb','level') >= intval(Board::Inst($this->bo_id)->bo_level_list)
) $pass=true;
