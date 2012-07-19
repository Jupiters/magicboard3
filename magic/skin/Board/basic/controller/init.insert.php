<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();		// 테이블명
$clear = $this->Clear();

$r = GV::String('r');
$id1 = GV::String('id1');
$id2 = GV::String('id2');
$clear['bo_admin_path'] = Url::Get(array('r'=>$r,'id1'=>$id1,'id2'=>$id2,'bo_no'=>$clear['bo_no'], $this->Mode('name')=>'write'));

$this->Action('insert_record', $clear);
Dialog::Alert("게시판 추가 완료!", $this->Link('list'));
