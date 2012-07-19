<?php if(!defined("__MAGIC__")) exit; 

if(!Member::Inst()->Action('is_admin'))
	Dialog::alert('관리자 권한이 필요한 서비스 입니다.');
