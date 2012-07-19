<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
$key = GV::Number($this->KN());

$state=$mode;
if($key && !$mode) $state = 'modify';
else if(!$key && !$mode) $state = 'list';
