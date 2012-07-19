<?php
include('_path.php');
$title="메뉴 & 레이아웃";

echo Layout::Inst('admin'
	)->Contents(
		array(Magic::Inst('admin')->html())
	)->html(
);
	