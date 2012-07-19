<?php if(!defined("__MAGIC__")) exit; 

$clear = $this->Clear();
if(!$clear['wr_content']) Dialog::alert('내용을 입력해 주세요.');

$this->Sql('update', $clear);
Dialog::alertNReplace("페이지 수정을 완료 하였습니다.", $this->Link('list'));
