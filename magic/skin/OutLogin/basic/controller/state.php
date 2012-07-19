<?php if(!defined("__MAGIC__")) exit; 


if(Member::Inst()->Action('is_login')) {
	$state='logout';
} else {
	$state='login';
}