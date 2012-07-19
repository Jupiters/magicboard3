<?php if(!defined('__MAGIC__')) exit;

$data = Widget::Inst()->Action('data_explode', $this->wg_no);
if($data['bo_no']) {
  echo Write::Inst($data['skin'], $data['bo_no']
      )->SetConfig('editor', 'name', $data['editor']
      )->SetConfig('editor', 'width', $data['editor_width']
      )->SetConfig('editor', 'height', $data['editor_height']
      )->html(
  );
} else {
  echo '게시판 번호가 없습니다.';
}
