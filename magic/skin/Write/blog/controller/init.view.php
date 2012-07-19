<?php if(!defined("__MAGIC__")) exit; 

// 게시글 조회수 업데이트
$key = GV::Number($this->KN());
$this->wr_no = $key;
// 세션이 끊어 졌을때만 다시 업데이트 함
if(!$_SESSION[$this->Config('hit_check').$key]) {
	$this->Sql('update_hit',$key);
	$_SESSION[$this->Config('hit_check').$key] = true;
}
$data = $this->Sql('fetch', $key);
$data['wr_content'] = Editor::Inst(Board::Inst()->bo_no($this->bo_no)->bo_editor)->db_out($data['wr_content']);

$this->sql['fetch'.$key] = $data;

$tags = array();
foreach(Tag::Inst()->Sql('list', $this->bo_no, $key) as $v) {
  $tags[] = $v['tag_name'];
}
$this->tags = $tags;

// 홈페이지 타이틀 설정
$title = array_merge(
  array($data['wr_subject']),
  array($data['wr_category']),
  PageElement::Inst('head')->Config('title')
);

PageElement::Inst('head')->SetConfig('title', '', $title);

// meta description
// descripttion은 과하지 않는것이 좋다.
// PageElement::Inst('head')->SetConfig('description', '', $data['wr_subject'].' '.strip_tags($data['wr_content']));

// meta keywords
PageElement::Inst('head')->SetConfig('keywords', '', implode(',',$tags));

