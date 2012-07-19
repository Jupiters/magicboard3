<?php if(!defined("__MAGIC__")) exit; 

/*
 * 입력받은 key와 현재 키가 같을 경우에만
 * 수정이나 다른 모드로 들어감
 * 아닐 경우에는 view 상태를 유지함
 */
$state='view';
$key = GV::Number($this->KN());

if($key==$this->wr_no) {
	$mode = GV::GetParam($this->Mode('name'), 'GET');
	if($mode) {
		$state = $mode;
	} else if($this->wr_no) {
		$state = 'view';
	}
}

