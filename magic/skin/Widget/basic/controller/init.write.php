<?php if(!defined("__MAGIC__")) exit; 

// 위젯선택으로 선택 하였을 때
$this->wgSkin = GV::String('wgSkin');

/*
 * 위젯을 선택하지 않았고
 * 위젯 수정모드일 때
 */
if(!$this->wgSkin && $this->wg_no) {
	$view = $this->Sql('fetch', $this->wg_no);
	$this->wgSkin = $view['wg_skin'];
}

/*
 * 위젯목록
 */
$list=array();

$this->widget_list[0] = array(
  0=>array(
    'link'=>$this->Link('skin_cancel'),
    'name'=>'선택하세요'
  )
);
foreach (Widget::Inst()->SkinList() as $v) {
  $v['link'] = $this->Link('skin',$v['skin']);
  $v['selected'] = $this->wgSkin==$v['skin']?'selected':'';
  $list[] = $v;
}
$this->widget_list['기본'] = $list;

$list=array();
foreach (Widget::Inst()->SkinList("관리자") as $v) {
  $v['link'] = $this->Link('skin',$v['skin']);
  $v['selected'] = $this->wgSkin==$v['skin']?'selected':'';
  $list[] = $v;
}
$this->widget_list['관리자'] = $list;

/*
 * 위젯수정 : 컨텐츠
 */
if($this->wgSkin) {
	$this->contents =  Widget::Inst($this->wgSkin, $this->wg_no)->Html();
} else {
  $this->contents = '위젯을 선택하세요';
}
