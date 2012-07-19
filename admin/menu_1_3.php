<?php
include('_path.php');
$title="개인정보수집 및 이용";

$contents = Config::Inst(
	)->show_title(false
	)->update(
		array('privacyofuse')
	)->html(
);

echo Layout::Inst('admin'
	)->Contents(array($contents)
	)->html(
);
