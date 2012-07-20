<?php if(!defined("__MAGIC__")) exit; 

$board = Board::Inst()->bo_no($this->bo_no);

$pass=false;
if(
	$board->bo_use_file &&
	(Member::Level() >= intVal($board->bo_file_level_upload))
) $pass = true;
