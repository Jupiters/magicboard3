<?php if(!defined("__MAGIC__")) exit; 

// 게시글 보기 이외에는 관리자여야함
if($this->CurrentState()!='view' && !Member::Inst()->Action('is_admin'))
	Dialog::alert("권한이 없습니다.");