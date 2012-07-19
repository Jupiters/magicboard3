<?php if(!defined("__MAGIC__")) exit; 

$this->contents = Member::Inst()->html();
$this->head = PageElement::Inst('head')->html();
