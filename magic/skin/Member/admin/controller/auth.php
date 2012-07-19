<?php if(!defined("__MAGIC__")) exit; 

if(!Member::Inst()->Action('is_admin'))
	Dialog::Alert("관리자만 접속 가능합니다.");