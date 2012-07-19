<?php
include('_path.php');
$title="HISTORY";

echo Layout::Inst('admin'
	)->Contents(
		array('<div style="line-height:1.6">'.nl2br(implode('', file(Path::MB('HISTORY')))).'</div>')
	)->html();
