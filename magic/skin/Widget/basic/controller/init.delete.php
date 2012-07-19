<?php if(!defined("__MAGIC__")) exit; 

// 현재 페이지 유지를 위해 간단하게 팝업으로 삭제URL을 호출함
$key = GV::Number($this->KN());
$this->Sql('delete', $key);
Url::GoReplace($_GET['ret_url']);

	