<?php if(!defined("__MAGIC__")) exit; 

if(!Member::IsLogin()) Dialog::alert('로그인이 필요한 서비스 입니다.');
