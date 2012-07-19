<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$clear = $this->Clear();
$clear['bo_no'] = $this->bo_no;
unset($clear['wr_no']);

// 현재 페이지의 id 생성
$last_id = array();
if($_GET['r']) $last_id[]='?r='.$_GET['r'];
if($_GET['id1']) $last_id[]='id1='.$_GET['id1'];
if($_GET['id2']) $last_id[]='id2='.$_GET['id2'];
$clear['last_id'] = implode('&',$last_id);
$clear['wr_datetime'] = 'NOW()';
$clear['wr_update'] = 'NOW()';

$key = DB::Get()->InsertEx($this->TBN(), $clear, array('wr_datetime', 'wr_update'));
if(!$key) Dialog::Alert('정확한 정보를 입력하세요.');

Url::GoReplace($this->Link('list'));
