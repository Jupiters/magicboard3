<?php if(!defined('__MAGIC__')) exit;
$v = Widget::Inst()->Action('data_explode', $this->wg_no);
echo Member::Inst($v['skin'])->html();
