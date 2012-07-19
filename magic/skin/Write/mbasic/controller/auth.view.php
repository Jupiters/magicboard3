<?php if(!defined("__MAGIC__")) exit; 

$check = $this->Can('view');
if($check==='password') {
	Url::GoReplace($this->Link('check'));
} else if($check==='incorrect') {
	Dialog::alert("패스워드가 틀렸습니다.");
} else if($check===false) {
	Dialog::alert("게시글 보기 권한이 없습니다.");
}

