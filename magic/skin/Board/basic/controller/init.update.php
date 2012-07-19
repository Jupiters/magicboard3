<?php if(!defined("__MAGIC__")) exit; 

$clear = $this->Clear();
if(!$clear['bo_subject']) Dialog::alert('게시판 명을 입력하세요.');

$r = GV::String('r');
$id1 = GV::String('id1');
$id2 = GV::String('id2');
$clear['bo_admin_path'] = Url::Get(array('r'=>$r,'id1'=>$id1,'id2'=>$id2,'bo_no'=>$clear['bo_no'], $this->Mode('name')=>'write'));

$where = " WHERE bo_no='{$clear['bo_no']}'  ";
DB::Get()->update($this->TBN(), $clear, $where);
Dialog::Alert("게시판 수정 완료!", $this->Link('list'));
