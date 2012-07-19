<?php if(!defined("__MAGIC__")) exit; 

$key = GV::Number($this->KN());
$mode = GV::GetParam($this->Mode('name'), 'GET');

$state='view';
if($this->wg_no==$key && $mode) {
  $state = $mode;
}
