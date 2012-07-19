<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['path'] = Path::popup('msg.php'); ///< 모듈호출위치

$cfg['mode']['name']		= 'msgMode';
$cfg['mode']['list']		= 'list';
$cfg['mode']['view']		= 'view';
$cfg['mode']['delete']		= 'delete';
$cfg['mode']['insert']		= 'insert';
$cfg['mode']['modify']		= 'modify';
$cfg['mode']['write']		= 'write';
$cfg['mode']['update']		= 'update';
$cfg['mode']['archive']		= 'archive';
$cfg['mode']['star']		= 'star';
$cfg['mode']['trash']		= 'trash';

$cfg['state']['read']		= 0x0001;
$cfg['state']['sent']		= 0x0002;
$cfg['state']['archive']	= 0x0004;
$cfg['state']['star']		= 0x0008;
$cfg['state']['trash']		= 0x0010;

$cfg['rows'] = 15;
$cfg['pop_width'] = 700;
$cfg['pop_height'] = 700;
