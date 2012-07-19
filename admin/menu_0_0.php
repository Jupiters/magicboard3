<?php
include_once('_path.php');
$title="전체 최신글";

echo Layout::Inst('admin'
	)->Contents(
		array(
		Latest::Inst('all'
			)->Rows(20
			)->html()
		)
	)->html(
);
	
	
