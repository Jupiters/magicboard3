<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
$key = GV::Number($this->KN());
	
$state='view';
if($this->wg_no==$key) {
	if($mode) {
		$state = $mode;
	} else {
		if(GV::String('wgMode')=='write') {
			$state='write';
		}
	}
}


