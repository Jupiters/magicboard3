<?php if(!defined("__MAGIC__")) exit; 

$mb_id = GV::Id('mb_id', 'POST');
$mb_passwd = $this->Sql('password',GV::Password('mb_passwd', 'POST'));

if(!$mb_id) Dialog::alert("아이디를 입력하세요");
if(!$mb_passwd) Dialog::alert("패스워드를 입력하세요");

if($this->mb_id($mb_id)->mb_passwd != $mb_passwd) {
	Dialog::alert("로그인에 실패 했습니다.\n아이디와 비밀번호를 확인하세요.");
	exit;
}

// 로그인
$this->Action('login', $this->mb_no);

if(GV::PrevUrl())
	Url::Go(GV::PrevUrl());
else
	Url::GoHome();

exit;
