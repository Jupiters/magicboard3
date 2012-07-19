<?php if(!defined("__MAGIC__")) exit; 

$board = Board::Inst($this->bo_no);

$cfg = array();
$cfg['rows'] = 5;
$cfg['bo_no'] = $board->bo_no;
$cfg['bo_subject'] = $board->bo_subject;
