<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['mode']['name']		= 'memberMode';
$cfg['session'] = 'ss_mb_no'; ///< 로그인 세션 명
//$cfg['path'] = Path::Group('member.php');

$cfg['grade'] = array(
  'admin'=>'관리자',
  'manager'=>'운영자',
  'member'=>'회원'
);


