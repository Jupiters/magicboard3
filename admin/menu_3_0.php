<?php
include_once('_path.php');
$title="게시판 설정";

echo Layout::Inst('admin'
	)->Contents(
		array(Board::Inst()->html())
	)->html(
);
