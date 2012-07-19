<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();
$cfg['mode']['name']		= 'wgLatest';

/*
 * 기본값
 */
$cfg['wg_width'] = '100';
$cfg['wg_width_unit'] = '%';
$cfg['rows'] = 5;

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,
	'name' => $m->mb_name,
	'admin' => $m->Action('is_admin'),
	'login' => $m->Action('is_login'),
	'level' => $m->mb_level
);
