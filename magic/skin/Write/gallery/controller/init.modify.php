<?php if(!defined("__MAGIC__")) exit; 

// 키값
$this->key = GV::Number($this->KN());
$this->title = '글수정';
// 게시판 설정
$this->config = Board::Inst()->bo_no($this->bo_no);
// 파일관련 모듈 
$this->file = File::Inst()->wr_no($this->key)->Protection();
// 업데이트 주소
$this->action = $this->Link('update');
// 목록으로 가기 주소
$this->link_list = $this->Link('list');
// 게시글 데이터
$this->data = $this->Sql('fetch', $this->key);
// 에디터
$this->editor = Editor::Inst('wr_content', $this->config->bo_editor)->db_edit($this->data['wr_content'])->html();
// 태그
$tags = array();
foreach(Tag::Inst()->Sql('list', $this->bo_no, $this->key) as $v) {
  $tags[] = $v['tag_name'];
}
$this->tags = implode(',', $tags);

