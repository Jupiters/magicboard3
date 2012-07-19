<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
$key = GV::Number($this->KN());
$state=$mode;

/*
 * 로그인이 되어 있지 않을때
 * 회원가입, 비밀번호찾기, 로그인
 */
if(!$this->Action('is_login')) {
	// 회원가입
	if($mode=='regist') {
		// 회원약관 동의 확인
		if(!$_POST['terms'] || !$_POST['privacy']) {
			$state = 'agreement'; // 회원 약관 동의값이 없을시 가입약관 출력
		}
	}
	
/*
 * 로그인이 되어 있을때
 * 회원정보보기, 정보수정, 비번수정, 회원탈퇴, 로그아웃, 비밀번호 체크
 */
} else {
	$m = $this;
	// 회원정보 보기와 로그아웃이 아닌  로그인 후의 모든 동작은 비밀번호 체크 과정을 거친다.
	if($mode!='view' && $mode!='logout') {
		// 회원 비밀번호 체크
		$passwd = $this->Sql('password', $_POST['passwd']);
		if(!$passwd) $state = 'check';
		else if($m->mb_passwd != $passwd) {
			Dialog::Alert("비밀번호를 잘못 입력 하셨습니다.");
		}
	}
}
	