<?php if(!defined("__MAGIC__")) exit; 

$this->logo = Layout::Inst('admin')->path_img('logo.png');
$this->logo_link = Path::Root('?r=admin');
$this->link_logout = Member::Inst()->Link('logout');
$this->link_home = Path::Root();
$this->btn_home = Layout::Inst('admin')->path_img('btn_home.gif');
$this->btn_logout = Layout::Inst('admin')->path_img('btn_logout.gif');

$this->link_design = Widget::Inst()->Config('link_design');
$this->link_page = Widget::Inst()->Config('link_page');

// 아이콘
if(Widget::Inst()->Config('is_design')) {
  $this->icon_design = Layout::Inst('admin')->path_img('icon_design_on.gif');
} else {
  $this->icon_design = Layout::Inst('admin')->path_img('icon_design_off.gif');
}
if(Widget::Inst()->Config('is_page')) {
  $this->icon_page = Layout::Inst('admin')->path_img('icon_page_on.gif');
} else {
  $this->icon_page = Layout::Inst('admin')->path_img('icon_page_off.gif');
}
