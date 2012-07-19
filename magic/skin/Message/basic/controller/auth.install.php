<?php if(!defined("__MAGIC__")) exit; 

if(!Member::IsSuperAdmin()) Dialog::alert('최고관리자 권한이 필요합니다.');
