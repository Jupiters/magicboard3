<?php if(!defined('__MAGIC__')) exit;
$v = Widget::Inst()->Action('data_explode', $this->wg_no);
echo Member::Inst($v['skin']                ///< 스킨
  )->SetConfig('rows', '', $v['rows']       ///< 목록 출력 개수
  )->html(
);
