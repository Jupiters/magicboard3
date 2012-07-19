<?php if(!defined("__MAGIC__")) exit; 

$board = Board::Inst()->bo_no($this->bo_no);
$mb_level = $this->Config('mb', 'level');

$pass=false;
if($mb_level>=$board->bo_comment_level_write)
	$pass=true;