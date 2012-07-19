<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
$key = GV::Number($this->KN());

$state='';
if(!$key && !$mode)	$state = 'list';
else				$state = $mode;
