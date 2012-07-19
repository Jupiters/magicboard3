<?php if(!defined("__MAGIC__")) exit; 

$board = Board::Inst($this->bo_id);

$cfg = array();
$cfg['rows'] = 2;
$cfg['cols'] = 5;
$cfg['width'] = 80;
$cfg['height'] = 80;
$cfg['bo_no'] = $board->bo_no;
$cfg['bo_subject'] = $board->bo_subject;
$cfg['bo_location'] = $board->bo_location;
