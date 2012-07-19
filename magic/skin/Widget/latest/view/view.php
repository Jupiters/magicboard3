<?php if(!defined('__MAGIC__')) exit;
$v = Widget::Inst()->Action('data_explode', $this->wg_no);
echo Latest::Inst($v['skin'], explode(',', $v['bo_no'])   ///< 스킨, 게시판 번호
  )->SetConfig('rows', '', $v['rows']       ///< 목록 출력 개수
  )->html(
);
