<?php if(!defined("__MAGIC__")) exit; 

$pass=false;
// 게시판 설정 읽어옴
$board = Board::Inst()->bo_no($this->bo_no);
// 게시글 데이터 읽어들임
$data = $this->Sql('fetch', $att[1]);

// 게시판 설정을 비교
if($this->Config('mb','level')>=intval($board->bo_level_delete)) {
	
	// 회원이 쓴 글
	if($data['mb_no']!=0) {
		// 회원 자신만 수정가능함
		if($data['mb_no'] == $this->Config('mb','no'))
			$pass = true;
	}
	// 비회원이 쓴 글
	else {
		if(GV::Anything('password')!='') {
			if($data['wr_password'] == $this->Sql('password', GV::Anything('password')))
				$pass = true;
			else
				$pass = 'incorrect';
		} else {
			$pass = 'password';
		}
	}
	
	// 삭제불가 댓글수 등 체크
	/*
	if(!$board->bo_del_comment) $del_comment=9999;
	else $del_comment=$board->bo_del_comment;

	if($del_comment>intVal($this->Sql('comment_count', $data['wr_no'])))
		$pass = true;
	//*/
}

// 관리자는 항상 삭제가능
if($this->Config('mb','admin')) $pass = true;


