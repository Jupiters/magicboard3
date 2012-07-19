<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
	
$state='list';
if($mode) $state=$mode;