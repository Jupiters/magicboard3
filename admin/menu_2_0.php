<?php
include_once('_path.php');
$title="회원관리";

echo Layout::Inst('admin'
	)->Contents(
		array(Member::Inst('admin')->html())
	)->html(
);
	
