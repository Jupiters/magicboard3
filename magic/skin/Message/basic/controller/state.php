<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam('msgMode', 'GET');
$msg_no = GV::Number('msg_no');
$check = $this->CheckInstall($this->TBN(), $this->Table()); // 설치후 라인제거

$state='';
if($check!==true)			$state = 'install'; // 설치후 삭제라인
elseif(!$mode && !$msg_no)	$state = 'list';	// 설치후 삭제라인
//if(!$mode && !$msg_no)	$state = 'list';	// 설치후 주석제거
elseif(!$mode && $msg_no)	$state = 'view';
else						$state = $mode;
