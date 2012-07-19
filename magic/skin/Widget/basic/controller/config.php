<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();
$cfg['design_mode']		= 'widget';
$cfg['page_mode']   	= 'page_edit';

$cfg['is_design']     = GV::String($cfg['design_mode']);
$cfg['link_design']   = Url::Get(array($cfg['design_mode']=>'true'), array($cfg['page_mode']));
if($cfg['is_design']) $cfg['link_design']   = Url::Get('', array($cfg['design_mode'],$cfg['page_mode']));

$cfg['is_page']     = GV::String($cfg['page_mode']);
$cfg['link_page']   = Url::Get(array($cfg['page_mode']=>'true'), array($cfg['design_mode']));
if($cfg['is_page']) $cfg['link_page']   = Url::Get('', array($cfg['page_mode'],$cfg['design_mode']));


$cfg['mode']['name']	= 'wgMode';

// widget add info
$cfg['add_widget'] = array(
	'table' => 'wgaif_table',
	'field' => 'wgaif_field',
	'key' => 'wgaif_key',
	'key_name' => 'wgaif_kn',
	'pos' => 'wgaif_pos'
);

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,					// 회원번호
	'name' => $m->mb_name,				// 회원명
	'admin' => $m->Action('is_admin'),	// 관리자 여부
	'login' => $m->Action('is_login'),	// 로그인 여부
	'level' => $m->mb_level				// 회원레벨
);
