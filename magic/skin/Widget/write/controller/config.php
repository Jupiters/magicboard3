<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['mode']['name']		= 'wgWrite';

/*
 * 기본값
 */
$cfg['wg_width'] = '100';
$cfg['wg_width_unit'] = '%';
$cfg['img_width'] = '500';
$cfg['rows'] = 20;
$cfg['list_view'] = 0;
$cfg['use_comment'] = 1;
$cfg['show_notice'] = 1;
// 'no|wr_datetime|wr_subject|wr_writer|wr_hit';
$cfg['columns'] = 'no|wr_datetime|wr_subject|wr_writer|wr_hit';
$cfg['columns_name'] = array(
  'no'=>'번호',
  'wr_datetime'=>'날짜',
  'wr_subject'=>'제목',
  'wr_writer'=>'글쓴이',
  'wr_hit'=>'조회'
);

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,
	'name' => $m->mb_name,
	'admin' => $m->Action('is_admin'),
	'login' => $m->Action('is_login'),
	'level' => $m->mb_level
);
