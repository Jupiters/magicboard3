<?php if(!defined("__MAGIC__")) exit; 

$clear = $this->Clear();
// 현재 페이지의 id 생성
$last_id = array();
if($_GET['r']) $last_id[]='?r='.$_GET['r'];
if($_GET['id1']) $last_id[]='id1='.$_GET['id1'];
if($_GET['id2']) $last_id[]='id2='.$_GET['id2'];
$clear['last_id'] = implode('&',$last_id);
if(!$clear['wr_content']) Dialog::alert('내용을 입력해 주세요.');

$key_name = $this->KN();
$key = GV::Number($key_name);
DB::Get()->update($this->TBN(), $clear, " WHERE {$key_name}='{$key}' ");

Url::GoReplace($this->Link('list'));
