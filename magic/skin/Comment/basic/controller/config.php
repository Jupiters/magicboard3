<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();
$cfg['mode']['name']		= 'cmtMode';

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,
	'nick' => $m->mb_nick,
	'admin' => $m->Action('is_admin'),
	'login' => $m->Action('is_login'),
	'level' => $m->mb_level
);

