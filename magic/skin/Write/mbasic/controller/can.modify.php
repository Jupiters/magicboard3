<?php if(!defined("__MAGIC__")) exit; 
/*
 * 게시글 수정 권한 검사
 * 게시판 설정을 불러들여서 비교 검사함
 * 결과값
 * -----------------------------
 * true = 통과
 * false = 수정할 수 없음
 * password = 패스워드 입력 요함
 * incorrect = 패스워드 틀림
 */

$pass=false;
$board = Board::Inst()->bo_no($this->bo_no);
$data = $this->Sql('fetch', $att[1]);		// 기존 게시글 정보

if(is_array($data) && sizeof($data)!=0) {
	// 게시판 설정보다 회원 레벨이 높거나 같다면
	if($this->Config('mb','level') >= intval($board->bo_level_modify)) {
		// 회원이 쓴 글이면 회원 자신만 수정가능함
		if($data['mb_no']!=0) {
			if($data['mb_no'] == $this->Config('mb','no'))
				$pass = true;
		}
		// 비회원이 쓴 글이면 비밀번호 검사
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
		
		// 수정불가 댓글수 등 체크
		//if(!$board->bo_mod_comment) $mod_comment=9999;
		//else $mod_comment=$board->bo_mod_comment;
		
		//if($mod_comment<=intVal($this->model->CountComment($data['wr_no'])))
		//	$pass = false;
	}
	if($this->Config('mb','admin')) $pass = true;
}
