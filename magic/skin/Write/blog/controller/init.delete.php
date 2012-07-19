<?php if(!defined("__MAGIC__")) exit; 

$key = $this->Key();

// 태그삭제
$tags = $_POST['tags'];
Tag::Inst()->Action('insert', $this->bo_no, $key, array());

// 게시글 하나 삭제
$this->Sql('delete', $key);

// 게시글에 포함된 파일 모두 삭제
foreach(File::Inst()->wr_no($key)->Action('files') as $v) {
	File::Inst()->Action('delete', $v);
}

Url::GoReplace($this->Link('list'));
