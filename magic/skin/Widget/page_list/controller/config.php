<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['mode']['name']		= 'wgPage';

/*
 * 기본값
 */
$cfg['wg_width'] = '100';
$cfg['wg_width_unit'] = '%';
$cfg['editor'] = 'cheditor';
$cfg['editor_width'] = '100%';
$cfg['editor_height'] = '300px';

/*
 * 페이지 수정버튼
$data = Widget::Inst()->Action('data_explode', $this->wg_no);
$cfg['button'][] = array(
	'name'=>'페이지수정',
	'href'=>Write::Inst('admin_page')->Link('write', $data['wr_no']),
	'class'=>'ui-icon-pencil'
);
 */

// 현재 로그인한 회원정보 저장
$m = Member::Inst();
$cfg['mb'] = array(
	'no' => $m->mb_no,
	'name' => $m->mb_name,
	'admin' => $m->Action('is_admin'),
	'login' => $m->Action('is_login'),
	'level' => $m->mb_level
);
