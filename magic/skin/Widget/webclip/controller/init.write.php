<?php if(!defined("__MAGIC__")) exit; 

Scripts::Add($this->path_view('write.js'));
/*
 * view data 불러오기
 * 우선순위
 * 1.POST로 넘어온 미리보기 데이터
 * 2.데이터베이스에 있는 데이터
 * 3.기본 데이터
 * 
 */

// 1.데이터베이스에 있는 데이터 불러오기
$view = Widget::Inst()->Action(
	'data_explode',
	$this->wg_no
);

$data = array();

// 위젯너비
$data['wg_width'] = GV::String('wg_width');
if(!$data['wg_width']) $data['wg_width'] = $view['wg_width'];
if(!$data['wg_width']) $data['wg_width'] = $this->Config('wg_width');
// 위젯너비 단위
$data['wg_width_unit'] = GV::String('wg_width_unit');
if(!$data['wg_width_unit']) $data['wg_width_unit'] = $view['wg_width_unit'];
if(!$data['wg_width_unit']) $data['wg_width_unit'] = $this->Config('wg_width_unit');
// 게시판 스킨
$data['skin'] = GV::String('skin');
if(!$data['skin']) $data['skin'] = $view['skin'];

$this->view = $data;

