<?php if(!defined('__MAGIC__')) exit;
$v = Widget::Inst()->Action('data_explode', $this->wg_no);
echo  Board::Inst($v['skin'])->html();
