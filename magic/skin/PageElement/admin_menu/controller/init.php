<?php if(!defined("__MAGIC__")) exit; 

// 메인메뉴
$this->menu_main= Magic::Inst()->Action('menu_main');

/*
 * 메인메뉴에 대한 기본설정
 */
$i=0;
$total=sizeof($this->menu_main);
foreach($this->menu_main as $k=>$v) {
  if(++$i==$total) $this->menu_main[$k]['last'] = true;
  $this->menu_main[$k]['icon'] = $this->path_img($v['m_image']);
}
