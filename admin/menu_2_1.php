<?php
include_once('_path.php');
$title="탈퇴회원관리";

echo Layout::Inst('admin'
	)->Contents(
		array(Member::Inst('admin_unregisted')->html())
	)->html(
);
