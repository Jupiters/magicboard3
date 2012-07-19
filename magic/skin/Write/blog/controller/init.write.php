<?php if(!defined("__MAGIC__")) exit; 

// 게시판 설정
$this->config = Board::Inst()->bo_no($this->bo_no);
// 현재위치 출력 모듈
$this->breadcrumb = PageElement::Inst('breadcrumb')->html();
// 에디터
$this->editor = Editor::Inst('wr_content', $this->config->bo_editor)->html();
// 파일관련 모듈 
$this->file = File::Inst()->wr_no($key)->Protection();
// 업데이트 주소
$this->action = $this->Link('insert');
// 목록으로 가기 주소
$this->link_list = $this->Link('list');

