<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
$state=$mode;
if(!$mode) $state = 'list';
