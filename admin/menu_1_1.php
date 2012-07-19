<?php
include('_path.php');
$title="회원관련";
$contents = Config::Inst()->update(
	array('mb_pic_width', 'mb_pic_height')
)->html();

echo Layout::Inst('admin'
	)->Contents(array($contents)
	)->html(
);
