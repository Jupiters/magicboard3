<?php if(!defined("__MAGIC__")) exit; 

// 게시글 하나 삭제
$this->Sql('delete', GV::Number($this->KN()));
Url::GoReplace($this->Link('list'));
