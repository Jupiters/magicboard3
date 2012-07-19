<?php if(!defined("__MAGIC__")) exit; 

/*
 * 해당 레이아웃에서 사용할 css/js set
 */
//Styles::Add(Path::Root('magic/css/basic/jquery-ui-all.css'));
//Styles::Add(Layout::Inst('admin')->path_view('style.css'));

/*
 * 페이지 엘리먼트 불러오기
 */
$this->header   = PageElement::Inst('admin_header')->html();
$this->menu     = PageElement::Inst('admin_menu')->html();
$this->head     = PageElement::Inst('head')->html();
