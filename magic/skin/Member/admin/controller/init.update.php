<?php if(!defined("__MAGIC__")) exit; 

// 걸러진 결과값
$clear = $this->Clear();
$functions = array();

// 비밀번호가 입력되어 있으면 암호화하여 받아온다
if($clear['mb_passwd']) {
	$clear['mb_passwd'] = $this->Sql('password', $clear['mb_passwd']);
} else {
	unset($clear['mb_passwd']);
}

if($_POST['mb_datetime_now']=='1') {
	$clear['mb_datetime'] = 'NOW()';
	$functions[] = 'mb_datetime';
}

// 필수입력 검사
if(!$clear['mb_nick']) Dialog::alert("별명을 입력하세요.");

// 회원정보 업데이트
$this->Sql('update', GV::Number($this->KN()), $clear, $functions);
Dialog::alertNReplace("회원정보가 수정되었습니다.", $this->Link('list'));

exit;
		