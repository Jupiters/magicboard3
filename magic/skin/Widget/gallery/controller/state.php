<?php if(!defined("__MAGIC__")) exit; 

$mode = GV::GetParam($this->Mode('name'), 'GET');
	
$state='view';
if($mode) {
	$state = $mode;
} else {
	if(GV::String('wgMode')=='write') {
		$state='write';
	}
}


