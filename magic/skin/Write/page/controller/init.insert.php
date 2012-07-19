<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$clear = $this->Clear();

if(!$clear['wr_subject']) Dialog::alert('페이지명을 입력해 주세요.');
$clear['bo_no'] = 0;

$key = $this->Sql('insert', $clear);
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');

Url::GoReplace($this->Link('list'));