<?php if(!defined('__MAGIC__')) exit;

$data = Widget::Inst()->Action('data_explode', $this->wg_no);
echo Write::Inst($data['skin'], 0, $data['wr_no']
    )->SetConfig('editor', 'name', $data['editor']
    )->SetConfig('editor', 'width', $data['editor_width']
    )->SetConfig('editor', 'height', $data['editor_height']
    )->html(
);
