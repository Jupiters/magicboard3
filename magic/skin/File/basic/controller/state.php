<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');

$state='';
if(!$mode)	$state = 'list';
else		$state = $mode;

