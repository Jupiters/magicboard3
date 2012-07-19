<?php if(!defined("__MAGIC__")) exit; 

$state = GV::String($this->Mode('name'));

if(!$state && !$this->Action('is_login')) {
	$state='login';
} else if(!$state) {
	$state='view';
}

	
