<?php
include_once('_path.php');
$title="Google Analytics";

$contents = Config::Inst(
	)->show_title(false
	)->update(
		array('googleanalytics')
	)->html(
);

echo Layout::Inst('admin'
	)->Contents(array($contents)
	)->html();
