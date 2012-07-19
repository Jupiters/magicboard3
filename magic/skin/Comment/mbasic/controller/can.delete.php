<?php if(!defined("__MAGIC__")) exit; 
/*
 * 삭제 가능한지 게시판 설정을 읽어들여서 비교함
 */
$cmt_no = $att[1];
$board = Board::Inst()->bo_no($this->bo_no);
$mb_level = $this->Config('mb', 'level');
$mb_no = $this->Config('mb', 'no');
$is_admin = $this->Config('mb','admin');
$data = $this->Sql('fetch', $cmt_no); // 데이터 읽어들임

$pass=false;
/*
 * 회원 레벨과 비교함
 * 자신의 글이라도 게시판 설정에 따라 삭제 불가능 할수도 있음
 */
if( $mb_level>=intval($board->bo_comment_level_delete) ) {
	// 자기가 쓴 글은 삭제 가능함
	if($mb_no == $data['mb_no']) $pass = true;
	// 비회원이 쓴 글은 일단 삭제 가능으로
	if($data['mb_no']==0) $pass = true;
}

// 관리자는 항상 삭제가능
if($is_admin) $pass = true;
