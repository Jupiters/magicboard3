<?php if(!defined("__MAGIC__")) exit; 

$board = Board::Inst($this->bo_id);

$pass=false;
if(
	$board->bo_use_file &&
	(Member::Level() >= intVal($board->bo_file_level_upload))
) $pass = true;