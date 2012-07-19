<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();
$cfg['mode']['name']		= 'pageMode';

// 에디터 설정
$cfg['editor']['name']		= 'cheditor';
$cfg['editor']['width']		= '100%';
$cfg['editor']['height']	= '750px';

$cfg['mb']['admin'] = Member::Inst()->Action('is_admin');

