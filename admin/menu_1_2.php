<?php
include('_path.php');
$title="홈페이지이용약관";

$contents = Config::Inst(
	)->show_title(false
	)->update(
		array('termsofuse')
	)->html(
);

echo Layout::Inst('admin'
	)->Contents(array($contents)
	)->html(
);
