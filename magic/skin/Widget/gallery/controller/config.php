<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['mode']['name']		= 'wgWrite';

/*
 * 기본값
 */
$cfg['wg_width'] = '100';
$cfg['wg_width_unit'] = '%';
$cfg['img_width'] = '500';
$cfg['cols'] = 4;
$cfg['rows'] = 3;
$cfg['list_view'] = 0;
$cfg['use_comment'] = 1;
$cfg['show_notice'] = 1;

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,
	'name' => $m->mb_name,
	'admin' => $m->Action('is_admin'),
	'login' => $m->Action('is_login'),
	'level' => $m->mb_level
);
