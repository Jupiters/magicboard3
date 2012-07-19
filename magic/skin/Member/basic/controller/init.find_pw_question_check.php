<?php if(!defined("__MAGIC__")) exit; 

$m = $this->Sql('fetch', GV::Number($this->KN()));

if(Config::Inst()->admin==$m['mb_id'])
	Dialog::Alert("최고관리자는 질문 답변으로 비밀번호를 찾을수 없습니다.");
	
if($m['mb_answer']!= $_POST['mb_answer']) {
	Dialog::Alert('답변이 틀렸습니다.');
} else {
	$new_passwd='';
	for($i=0; $i<=7; $i++) {
		$new_passwd.=substr('23456789abcdef', rand(0,13), 1);
	}
	$this->Sql('change_password', $m['mb_no'], $new_passwd);
	// 비밀번호 바꾸고 바뀐 비밀번호 알려주기
	Dialog::alertNReplace("임시 비밀번호는 {$new_passwd} 입니다.\n개인정보에서 꼭 비밀번호를 변경하세요.", $this->Link('login'));
}
