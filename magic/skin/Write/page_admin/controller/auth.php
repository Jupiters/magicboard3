<?php if(!defined("__MAGIC__")) exit; 

// 게시글 목록보기 이외에는 관리자여야함
// 글 수정 삭제 등은 관리자 권한이 있어야함
if($this->CurrentState()!='list' && !$this->Config('mb','admin'))
	Dialog::alert("권한이 없습니다.");
