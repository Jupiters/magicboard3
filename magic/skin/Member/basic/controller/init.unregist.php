<?php if(!defined("__MAGIC__")) exit; 

// 스펨  차단코드 검사
Captcha::Inst()->Check();

$m = $this->Action('login_info');

$passwd = $this->Sql('password', $_POST['mb_passwd']);
if($passwd!=$m['mb_passwd'])
	Dialog::alert("기존 비밀번호가 맞지 않습니다.\n다시한번 확인하세요.");
	
// 파일을 업로드 했을 때 이전 파일들은 지움 
$f = File::Inst();
$files = array();
foreach ($f->mb_no($m['mb_no'])->Action('files') as $v)
	$files[] = $v['file_no'];

// 삭제해야할 파일들 삭제
foreach ($files as $v) {
	$f->Action('delete', $v);
}

$this->Sql('unregist', $m['mb_no'], GV::String('mb_memo'));
$this->Action('logout');
Dialog::alert("정상적으로 회원탈퇴 되었습니다.\n그동안 이용해 주셔서 감사합니다.", Path::Group());

exit;
