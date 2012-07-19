<?php if(!defined("__MAGIC__")) exit; 

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

// 위젯스킨
$data['wg_skin'] = GV::String('wgSkin');
if(!$data['wg_skin']) $data['wg_skin'] = $view['wg_skin'];

// 위젯너비
$data['wg_width'] = GV::String('wg_width');
if(!$data['wg_width']) $data['wg_width'] = $view['wg_width'];
if(!$data['wg_width']) $data['wg_width'] = $this->Config('wg_width');

// 위젯너비 단위
$data['wg_width_unit'] = GV::String('wg_width_unit');
if(!$data['wg_width_unit']) $data['wg_width_unit'] = $view['wg_width_unit'];
if(!$data['wg_width_unit']) $data['wg_width_unit'] = $this->Config('wg_width_unit');

// 목록 갯수
$data['rows'] = GV::Number('rows');
if(!$data['rows']) $data['rows'] = $view['rows'];
if(!$data['rows']) $data['rows'] = $this->Config('rows');

// 게시판 번호
$data['bo_no'] = GV::Number('bo_no');
if(!$data['bo_no']) $data['bo_no'] = $view['bo_no'];

// 게시판 번호
$data['cf_id'] = GV::Number('cf_id');
if(!$data['cf_id']) $data['cf_id'] = $view['cf_id'];
$data['cf_id'] = explode(',',$data['cf_id']);

// 게시판 스킨
$data['skin'] = GV::String('skin');
if(!$data['skin']) $data['skin'] = $view['skin'];

$this->data = $data;

/*
 * 폼 업데이트 링크 생성
 */
$key_name = $this->KN();
$key = GV::Number($key_name);
$this->action = $this->Link('insert');
if($key) {
  $this->action = $this->Link('update');
}

/*
 * 게시판 목록 : 기존에 생성된 것
 */
$board_list = array();
$board_list[] = array(
  'bo_subject'=>'게시판선택'
);
foreach (Board::Inst()->Sql('list') as $v) {
  if($data['bo_no']==$v['bo_no']) $v['selected'] = 'selected';
  $board_list[] = $v;
}
$this->board_list = $board_list;

/*
 * 게시판 스킨 목록
 */
$skin_list = array();
$skin_list[] = array(
  'name'=>'최신글스킨선택'
);
foreach (Latest::Inst()->SkinList() as $v) {
  if($data['skin']==$v['skin']) $v['selected'] = 'selected';
  $skin_list[] = $v;
}
$this->skin_list = $skin_list;

/*
 * 하단 버튼 링크생성
 */
$this->btn_ok = Widget::Inst()->path_img('btn_ok.gif');
$this->btn_cancel = Widget::Inst()->path_img('btn_cancel.gif');

