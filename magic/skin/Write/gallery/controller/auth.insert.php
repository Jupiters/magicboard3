<?php if(!defined("__MAGIC__")) exit; 

// 지엠스팸프리 검사
if(!$this->Config('mb','login')) Captcha::Inst()->Check();
if(!$this->Can('write')) {
	Dialog::alert("글쓰기 권한이 없습니다.");
}