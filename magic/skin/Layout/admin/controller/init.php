<?php if(!defined("__MAGIC__")) exit; 

/*
 * 해당 레이아웃에서 사용할 css/js set
 */
Styles::Add(Path::Group('magic/css/basic/jquery-ui-all.css'));

/*
 * 페이지 엘리먼트 불러오기
 */
$this->header   = PageElement::Inst('admin_header')->html();
$this->side     = PageElement::Inst('admin_side')->html();
$this->menu     = PageElement::Inst('admin_menu')->html();
$this->head     = PageElement::Inst('head')->html();

