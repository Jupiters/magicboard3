<?php if(!defined('__MAGIC__')) exit;

$data = $this->view;
if(!$data) {
	$data = Widget::Inst()->Action(
		'data_explode',
		$this->wg_no
	);
}

/*
 * 다른 위젯에서 넘어오는 스킨명의 오류를 방지하기 위해 검사함
 */
$skin_list = PageElement::Inst()->SkinList();
$pass=false;
foreach($skin_list as $v) {
	if($v['skin']==$data['skin']) {
		$pass=true;
	}
}
if($pass) {
  echo PageElement::Inst($data['skin'])->html();
}
