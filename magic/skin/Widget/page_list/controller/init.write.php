<?php if(!defined("__MAGIC__")) exit; 

Scripts::Add($this->path_view('widget.js'));

/*
 * view data 불러오기
 * 우선순위
 * 1.POST로 넘어온 미리보기 데이터
 * 2.데이터베이스에 있는 데이터
 * 3.기본 데이터
 * 
 */

// 데이터베이스에 있는 데이터 불러오기
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

// 게시글번호
$data['wr_no'] = GV::Number('wr_no');
if(!$data['wr_no']) $data['wr_no'] = $view['wr_no'];

// 에디터
$data['skin'] = GV::String('skin');
if(!$data['skin']) $data['skin'] = $view['skin'];
if(!$data['skin']) $data['skin'] = $this->Config('skin');

// 에디터
$data['editor'] = GV::String('editor');
if(!$data['editor']) $data['editor'] = $view['editor'];
if(!$data['editor']) $data['editor'] = $this->Config('editor');

// 에디터 너비
$data['editor_width'] = GV::String('editor_width');
if(!$data['editor_width']) $data['editor_width'] = $view['editor_width'];
if(!$data['editor_width']) $data['editor_width'] = $this->Config('editor_width');

// 에디터 높이
$data['editor_height'] = GV::String('editor_height');
if(!$data['editor_height']) $data['editor_height'] = $view['editor_height'];
if(!$data['editor_height']) $data['editor_height'] = $this->Config('editor_height');

$this->data = $data;

// 에디터 목록
$this->editor_list = Editor::Inst('')->SkinList();

$this->action = $this->Link('insert');
if($this->wg_no) {
	$this->action = $this->Link('update', $this->wg_no);
}

/*
 * 페이지 게시판 스킨 목록
 */
$skin_list = array();
$skin_list[] = array(
  'name'=>'스킨 선택'
);
foreach (Write::Inst()->SkinList('page_list') as $v) {
  if($data['skin']==$v['skin']) $v['selected'] = 'selected';
  $skin_list[] = $v;
}
$this->skin_list = $skin_list;

/*
 * 하단 버튼 링크생성
 */
$this->btn_ok = Widget::Inst()->path_img('btn_ok.gif');
$this->btn_cancel = Widget::Inst()->path_img('btn_cancel.gif');

