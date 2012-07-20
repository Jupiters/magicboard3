<?php if(!defined("__MAGIC__")) exit; 

$pass=false;
$board = Board::Inst()->bo_no($this->bo_no);
$data = $this->Sql('fetch', GV::Number($this->KN()));

if(is_array($data) && sizeof($data)!=0) {

	if($this->Config('mb','level')>=intval($board->bo_level_view)) {
		// 비밀글이면 패스워드 확인
		if($data['wr_is_secret']!=0) {
			// 비회원이 쓴 비밀 글이라면 GET으로 비밀번호 받아와서 읽어 들임
			if($data['mb_no']==0) {
				if(GV::Anything('password')!='') {
					if($data['wr_password'] == $this->Sql('password', GV::Anything('password')))
						$pass = true;
					else
						$pass = 'incorrect';
				} else {
					$pass = 'password';
				}
			}
			// 회원이 쓴 글이라면 해당 회원만 읽기 가능
			else if($data['mb_no'] == Member::Inst()->mb_no) {
				$pass = true;
			}
		} else {
			$pass = true;
		}
	}
}

if($this->Config('mb','admin')) $pass = true;
