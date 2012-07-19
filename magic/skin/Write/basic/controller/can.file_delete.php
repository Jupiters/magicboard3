<?php if(!defined("__MAGIC__")) exit; 

$board = Board::Inst($this->bo_id);
$data = $this->Sql('fetch', GV::Number($this->KN()));

$pass=false;

// 회원이 올린 파일이면
if( $data['mb_no'] != 0 ) {
	if(
		Member::No() == $data['mb_no'] &&
		Member::Level() >= intVal($board->bo_file_level_upload)
	) $pass = true;
} else {
	if( 1 == intVal($board->bo_file_level_upload) )
		$pass = true;
}

if( Member::IsAdmin() ) $pass = true;