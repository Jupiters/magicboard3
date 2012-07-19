<?php if(!defined("__MAGIC__")) exit; 

$pass=false;
if($this->Action('is_login'))
	$pass = true;