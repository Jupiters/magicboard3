<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

/*
 * 기본값
 */
if(Config::Inst()->hp_title) {
	$cfg['title'][0] = Config::Inst()->hp_title;
}
$cfg['title'] = Magic::Inst()->Action('title_chain');

$cfg['script'] = Scripts::Get();
$cfg['style'] = Styles::Get();



