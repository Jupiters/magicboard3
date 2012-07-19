<?php if(!defined("__MAGIC__")) exit; 

// 스펨  차단코드 검사
Captcha::Inst()->Check();
$m = $this->Action('login_info');

$passwd = $this->Sql('password', $_POST['old_passwd']);
if($passwd!=$m['mb_passwd'])
	Dialog::alert("기존 비밀번호가 맞지 않습니다.\n다시한번 확인하세요.");
	
$password = GV::Password('mb_passwd');
$password_check = GV::Password('mb_passwd_check');

if(!$password) Dialog::alert("변경할 비밀번호를 입력하세요.");
if($password != $password_check) Dialog::alert("변경할 비밀번호가 일치 하지 않습니다.");
if($password==$_POST['old_passwd']) Dialog::alert("이전 비밀번호와 동일합니다.");

$this->Sql('change_password', $password);

$this->Action('logout');
Dialog::alertNReplace("비밀번호가 수정되었습니다.\n다시 로그인 하세요.", htmlspecialchars_decode($this->Link('login')));
