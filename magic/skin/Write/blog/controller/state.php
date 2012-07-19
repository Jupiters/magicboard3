<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
$wr_no = GV::Number($this->KN());
$check = $this->Config('pw_check');
	
$state='';
if($check) {
	$state='password';
} else if(!$mode) {
	if($wr_no!='') $state='view';
	else if($wr_no=='') $state='list';
} else if($mode) {
	$state = $mode;
}

/*
 * 게시판 검사
 * 보기 모드 일때
 * 게시판이 같지 않으면 항상 목록을 보여줌
 */
if($state=='view') {
	$data = $this->Sql('fetch', $wr_no);
	if($data['bo_no']!=$this->bo_no) {
		$state = 'list';
	}
}
