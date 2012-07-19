<?php
include('_path.php');
$title="기본환경변수";
$config = Config::Inst()->update(
	array(
		'hp_title',
		'admin',
		'path_admin',
		'path_member'
	)
)->html();

echo Layout::Inst('admin'
	)->Contents(array($config)
	)->html();
	
